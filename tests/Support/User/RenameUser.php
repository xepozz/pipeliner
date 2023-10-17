<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner\Tests\Support\User;

use Xepozz\Pipeliner\PipelineInterface;
use Xepozz\Pipeliner\StackInterface;
use Xepozz\Pipeliner\Tests\Support\ActionStorage;

class RenameUser implements PipelineInterface
{
    private ActionStorage $actionStorage;

    public function __construct(
        private readonly string $newName,
    ) {
    }

    public function pipe(PipelineInterface $pipeline, StackInterface $stack): PipelineInterface
    {
        if ($pipeline instanceof User) {
            $this->actionStorage->add('Rename user: ' . $pipeline->name . ' -> ' . $this->newName);
            return $pipeline->withName($this->newName);
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