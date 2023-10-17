<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner;

class Sum implements PipelineInterface
{
    public function pipe(PipelineInterface $pipeline, StackInterface $stack): PipelineInterface
    {
        if ($pipeline instanceof Arguments) {
            return new Result(array_sum($pipeline->args));
        }
        return $pipeline;
    }
}