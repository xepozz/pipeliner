<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner;

interface StackInterface
{
    public function pop(): ?PipelineInterface;
}