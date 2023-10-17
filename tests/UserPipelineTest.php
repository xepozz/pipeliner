<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Xepozz\Pipeliner\ResultCatcher;
use Xepozz\Pipeliner\Pipeliner;
use Xepozz\Pipeliner\Stack;
use Xepozz\Pipeliner\Tests\Support\ActionStorage;
use Xepozz\Pipeliner\Tests\Support\User\CreateUser;
use Xepozz\Pipeliner\Tests\Support\User\LoginUser;
use Xepozz\Pipeliner\Tests\Support\User\RenameUser;
use Xepozz\Pipeliner\Tests\Support\User\User;

class UserPipelineTest extends TestCase
{
    #[DataProvider('dataPipeline')]
    public function testPipeliner(array $pipelines, User $expectedResult, array $expectedActions)
    {
        $actionStorage = new ActionStorage();
        foreach ($pipelines as &$pipeline) {
            $pipeline = $pipeline->withActionStorage($actionStorage);
        }

        $stack = new Stack(
            ...$pipelines
        );
        $catcher = new ResultCatcher();
        $pipeliner = new Pipeliner($stack);

        $result = $pipeliner->pipe($catcher);

        $this->assertEquals($expectedResult, $result);

        $this->assertEquals(
            $expectedActions,
            $actionStorage->actions
        );
    }

    public static function dataPipeline(): iterable
    {
        yield 'regular' => [
            [
                new User('Dmitry', 'd@d.d', '123'),
                new CreateUser(),
                new LoginUser(),
                new RenameUser('Dimon'),
            ],
            new User('Dimon', 'd@d.d', '123'),
            [
                'Create user: Dmitry',
                'Login user: Dmitry',
                'Rename user: Dmitry -> Dimon',
            ],
        ];
    }
}