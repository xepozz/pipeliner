<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner;

class ResultCatcher implements PipelineInterface
{
    private $value;

    public function __construct()
    {
    }

    public function pipe(PipelineInterface $pipeline, StackInterface $stack): PipelineInterface
    {
        if ($pipeline instanceof Result) {
            $this->value = $pipeline->result;
        }
        return $pipeline;
    }

    public function getValue()
    {
        return $this->value;
    }
}