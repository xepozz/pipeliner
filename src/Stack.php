<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner;

class Stack implements StackInterface
{
    /**
     * @var PipelineInterface[]
     */
    private array $stack;

    public function __construct(
        PipelineInterface ...$pipelines,
    )
    {
        $this->stack = $pipelines;
    }

    public function pop(): ?PipelineInterface
    {
        return array_shift($this->stack);
    }
}