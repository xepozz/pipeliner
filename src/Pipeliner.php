<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner;

final class Pipeliner
{
    public function __construct(
        private readonly StackInterface $stack,
    ) {
    }

    public function pipe(PipelineInterface $pipeline): PipelineInterface
    {
        $latest = $pipeline;
        $p = $this->stack->pop();

        while ($pipeline = $this->stack->pop()) {
            $p = $pipeline->pipe($p, $this->stack);
        }

        return $latest->pipe($p, $this->stack);
    }
}