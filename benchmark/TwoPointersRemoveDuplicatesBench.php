<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\benchmarks;

use PhpBench\Attributes\Groups;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;

use function kuaukutsu\ec\algo\TwoPointers\generate;
use function kuaukutsu\ec\algo\TwoPointers\remove_duplicates;
use function kuaukutsu\ec\algo\TwoPointers\remove_duplicates_with_copy;

#[Revs(1000)]
#[Iterations(10)]
#[Groups(['duplicates', 'two-pointers'])]
final class TwoPointersRemoveDuplicatesBench
{
    private array $number;

    public function __construct()
    {
        $this->number = generate(0, 1000);
    }

    public function benchAsWhile(): int
    {
        $arr = remove_duplicates($this->number);
        return count($arr);
    }

    public function benchAsWhileCopy(): int
    {
        $arr = remove_duplicates_with_copy($this->number);
        return count($arr);
    }

    public function benchAsInnerFunc(): int
    {
        $arr = array_unique($this->number);
        return count($arr);
    }
}
