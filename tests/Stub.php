<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner\Tests;

use PHPUnit\Framework\TestCase;
use Xepozz\Pipeliner\Arguments;
use Xepozz\Pipeliner\Pipeline;
use Xepozz\Pipeliner\Sum;

class Stub
{
    #[Arguments(1, 2)]
    #[Sum]
    #[Arguments(Pipeline::PREVIOUS_RESULT, Pipeline::PREVIOUS_RESULT)]
    private $test;
}