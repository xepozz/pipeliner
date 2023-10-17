# Pipeliner

A sequence runner in PHP.

## Example

```php
use Xepozz\Pipeliner\Arguments;
use Xepozz\Pipeliner\Pipeliner;
use Xepozz\Pipeliner\ResultCatcher;
use Xepozz\Pipeliner\Stack;
use Xepozz\Pipeliner\Sum;

$stack = new Stack(
    new Arguments(1, 2),
    new Sum(),
);
$pipeliner = new Pipeliner($stack);

$catcher = new ResultCatcher();
$pipeliner->pipe($catcher);

var_dump($catcher->getValue()); // 3
```

## Implementation

```php
class Sum implements PipelineInterface
{
    public function __construct()
    {
    }

    public function pipe(PipelineInterface $pipeline, StackInterface $stack): PipelineInterface
    {
        if ($pipeline instanceof Arguments) {
            return new Result(array_sum($pipeline->args));
        }
        return $pipeline;
    }
}
```
```php
class Arguments implements PipelineInterface
{
    public readonly array $args;

    public function __construct(int ...$args)
    {
        $this->args = $args;
    }

    public function pipe(PipelineInterface $pipeline, StackInterface $stack): PipelineInterface
    {
        return $pipeline;
    }
}
```
