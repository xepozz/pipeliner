<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner;

interface PipelineInterface
{
    public function pipe(PipelineInterface $pipeline, StackInterface $stack): self;
}