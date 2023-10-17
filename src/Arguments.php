<?php

declare(strict_types=1);

namespace Xepozz\Pipeliner;

class Arguments implements PipelineInterface
{
    /**
     * @var int[]|Arguments[]|Pipeline[]
     */
    public array $args;

    public function __construct(
        int|self|Pipeline ...$args,
    ) {
        $this->args = $args;
    }

    public function pipe(PipelineInterface $pipeline, StackInterface $stack): PipelineInterface
    {
        if ($pipeline instanceof Result) {
            while (false !== $index = array_search(Pipeline::PREVIOUS_RESULT, $this->args, true)) {
                $this->args[$index] = $pipeline->result;
            }
            return $this;
        }
        return $pipeline;
    }
}