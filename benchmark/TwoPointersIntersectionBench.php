<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\benchmarks;

use PhpBench\Attributes\Groups;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;

use function kuaukutsu\ec\algo\TwoPointers\get_list_number;
use function kuaukutsu\ec\algo\TwoPointers\list_intersection_direct;
use function kuaukutsu\ec\algo\TwoPointers\list_intersection_reverse;

#[Revs(1000)]
#[Iterations(10)]
#[Groups(['intersection', 'two-pointers'])]
final class TwoPointersIntersectionBench
{
    private array $listFirst;

    private array $listSecond;

    public function __construct()
    {
        $this->listFirst = get_list_number(0, 1000);
        $this->listSecond = get_list_number(0, 1000);
    }

    public function benchAsDirect(): int
    {
        $arr = list_intersection_direct($this->listFirst, $this->listSecond);
        return count($arr);
    }

    public function benchAsReverse(): int
    {
        $arr = list_intersection_reverse($this->listFirst, $this->listSecond);
        return count($arr);
    }

    /**
     * Не то же самое, но вроде самая близкая по сути внутренняя функция.
     */
    public function benchAsInnerFunc(): int
    {
        $arr = array_intersect($this->listFirst, $this->listSecond);
        return count($arr);
    }
}
