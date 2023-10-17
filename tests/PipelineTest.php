<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Xepozz\Pipeliner\Arguments;
use Xepozz\Pipeliner\ResultCatcher;
use Xepozz\Pipeliner\Pipeline;
use Xepozz\Pipeliner\Pipeliner;
use Xepozz\Pipeliner\Stack;
use Xepozz\Pipeliner\Sum;

class PipelineTest extends TestCase
{
    #[DataProvider('dataPipeline')]
    public function testPipeliner(array $pipelines, int $expectedResult)
    {
        $stack = new Stack(
            ...$pipelines
        );
        $catcher = new ResultCatcher();
        $pipeliner = new Pipeliner($stack);

        $pipeliner->pipe($catcher);
        $value = $catcher->getValue();

        $this->assertEquals($expectedResult, $value);
    }

    public static function dataPipeline()
    {
        yield 'regular' => [
            [
                new Arguments(1, 2),
                new Sum(),
                new Arguments(1, 1),
                new Sum(),
            ],
            2,
        ];
        yield 'previous one' => [
            [
                new Arguments(1, 2),
                new Sum(),
                new Arguments(Pipeline::PREVIOUS_RESULT, 2),
                new Sum(),
            ],
            5,
        ];
        yield 'previous two' => [
            [
                new Arguments(1, 2),
                new Sum(),
                new Arguments(Pipeline::PREVIOUS_RESULT, Pipeline::PREVIOUS_RESULT),
                new Sum(),
            ],
            6,
        ];
        yield 'previous two and 1 between' => [
            [
                new Arguments(1, 2),
                new Sum(),
                new Arguments(Pipeline::PREVIOUS_RESULT, 1, Pipeline::PREVIOUS_RESULT),
                new Sum(),
            ],
            7,
        ];
    }
}