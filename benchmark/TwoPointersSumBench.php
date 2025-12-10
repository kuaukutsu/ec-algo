<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\benchmarks;

use PhpBench\Attributes\Groups;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;

use function kuaukutsu\ec\algo\TwoPointers\get_indexes_by_sum;
use function kuaukutsu\ec\algo\TwoPointers\get_indexes_by_sum_recursive;
use function kuaukutsu\ec\algo\TwoPointers\get_list_number;

#[Revs(1000)]
#[Iterations(10)]
#[Groups(['sum'])]
final class TwoPointersSumBench
{
    private array $nums;

    private int $target;

    public function __construct()
    {
        $this->nums = get_list_number(0, 1000);

        [$targetPointLeft, $targetPointRight] = array_rand($this->nums, 2);
        $this->target = $this->nums[$targetPointLeft] + $this->nums[$targetPointRight];
    }

    public function benchAsWhile(): int
    {
        $arr = get_indexes_by_sum($this->nums, $this->target);
        return count($arr);
    }

    public function benchAsRecursive(): int
    {
        $arr = get_indexes_by_sum_recursive($this->nums, $this->target);
        return count($arr);
    }
}
