<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner\Tests\Support\User;

use Xepozz\Pipeliner\PipelineInterface;
use Xepozz\Pipeliner\StackInterface;
use Xepozz\Pipeliner\Tests\Support\ActionStorage;

class CreateUser implements PipelineInterface
{
    private ActionStorage $actionStorage;

    public function pipe(PipelineInterface $pipeline, StackInterface $stack): PipelineInterface
    {
        if ($pipeline instanceof User) {
            $this->actionStorage->add('Create user: ' . $pipeline->name);
            return $pipeline;
        }
        return $pipeline->pipe($this, $stack);
    }

    public function withActionStorage(ActionStorage $actionStorage): self
    {
        $new = clone $this;
        $new->actionStorage = $actionStorage;
        return $new;
    }
}