<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner\Tests\Support\User;

use Xepozz\Pipeliner\PipelineInterface;
use Xepozz\Pipeliner\StackInterface;
use Xepozz\Pipeliner\Tests\Support\ActionStorage;

class User implements PipelineInterface
{
    private ActionStorage $actionStorage;

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }

    public function pipe(PipelineInterface $pipeline, StackInterface $stack): PipelineInterface
    {
        $this->actionStorage->add('Declare user: ' . $this->name);
        return $pipeline->pipe($this, $stack);
    }

    public function withName(string $newName): self
    {
        return new self($newName, $this->email, $this->password);
    }

    public function withActionStorage(ActionStorage $actionStorage): self
    {
        $new = clone $this;
        $new->actionStorage = $actionStorage;
        return $new;
    }
}