<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner\Tests\Support;

class ActionStorage
{
    public array $actions;

    public function add(string $action): void
    {
        $this->actions[] = $action;
    }
}