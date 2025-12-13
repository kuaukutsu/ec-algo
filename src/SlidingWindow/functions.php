<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\SlidingWindow;

use Throwable;

/**
 * @param positive-int $size
 * @param positive-int $factor
 * @return non-empty-list<int>
 */
function generate(int $size, int $factor = 1000): array
{
    $list = [];
    $num = 1;
    $maxInt = $factor * $size;
    while ($size > 0) {
        try {
            $num = random_int(0, $maxInt + $num);
        } catch (Throwable) {
            $num++;
        }

        $list[] = $num;
        $size--;
    }

    return $list;
}

/**
 * @template TValue of int
 * @param non-empty-list<TValue> $list
 * @param positive-int $lengthSlice
 * @return list<TValue>
 */
function find_slice_max_sum(array $list, int $lengthSlice): array
{
    assert($lengthSlice <= count($list));

    $windowSum = 0;
    $windowSlice = [];
    for ($i = 0; $i < $lengthSlice; $i++) {
        $windowSum += $list[$i];
        $windowSlice[] = $list[$i];
    }

    $pointer = $lengthSlice;
    while ($pointer < count($list)) {
        $slidingWindow = [...array_slice($windowSlice, 1, $lengthSlice), $list[$pointer]];
        $slidingWindowSum = array_sum($slidingWindow);
        if ($slidingWindowSum > $windowSum) {
            $windowSlice = $slidingWindow;
            $windowSum = $slidingWindowSum;
        }

        $pointer++;
    }

    return $windowSlice;
}

/**
 * @template TValue of int
 * @param non-empty-list<TValue> $list
 * @param positive-int $limitSum
 * @return list<TValue>
 */
function find_slice_max_length_less_than_sum(array $list, int $limitSum): array
{
    assert($limitSum > min($list));

    $window = [];
    $windowSum = 0;
    $windowMax = [];

    $pointer = 0;
    while ($pointer < count($list)) {
        $value = $list[$pointer];
        if ($value >= $limitSum) {
            $window = [];
            $windowSum = 0;
            $pointer++;
            continue;
        }

        $window[] = $value;
        $windowSum += $value;
        if ($windowSum > $limitSum) {
            $window = array_slice($window, 1, -1);
            $windowSum = array_sum($window);
            continue;
        }

        // save
        if (count($window) > count($windowMax)) {
            $windowMax = $window;
        }

        // next
        $pointer++;
    }

    return $windowMax;
}
