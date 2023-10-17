<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner;

final class Result implements PipelineInterface
{
    public function __construct(
        public mixed $result,
    ) {
    }

    public function pipe(PipelineInterface $pipeline, StackInterface $stack): PipelineInterface
    {
        return $pipeline;
    }
}