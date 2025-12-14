<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\benchmarks;

use PhpBench\Attributes\Groups;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;

use function kuaukutsu\ec\algo\SlidingWindow\find_largest_slice_all_characters_unique;
use function kuaukutsu\ec\algo\SlidingWindow\find_largest_slice_all_characters_unique_fast;
use function kuaukutsu\ec\algo\SlidingWindow\generate_word;

#[Revs(10000)]
#[Iterations(10)]
#[Groups(['sliding-window'])]
final class SlidingWindowBench
{
    private string $str;

    public function __construct()
    {
        $this->str = generate_word(100);
    }

    public function benchAsWhile(): int
    {
        $slice = find_largest_slice_all_characters_unique($this->str);
        return count($slice);
    }

    public function benchAsFast(): int
    {
        $slice = find_largest_slice_all_characters_unique_fast($this->str);
        return count($slice);
    }
}
