<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\TwoPointers;

use Throwable;

/**
 * @param non-negative-int $numStart
 * @param positive-int $size
 * @return non-empty-list<non-negative-int>
 */
function get_list_number(int $numStart, int $size): array
{
    $list = [];
    while ($size > 0) {
        try {
            /** @phpstan-ignore argument.type */
            $numStart = random_int($numStart, $numStart + $size);
        } catch (Throwable) {
            $numStart++;
        }

        $list[] = $numStart;
        $size--;
    }

    return $list;
}

/**
 * @param non-empty-list<non-negative-int> $listFirst
 * @param non-empty-list<non-negative-int> $listSecond
 * @return list<non-negative-int>
 */
function list_intersection_direct(array $listFirst, array $listSecond): array
{
    $result = [];

    $pointerFirst = 0;
    $pointerSecond = 0;
    $countFirst = count($listFirst);
    $countSecond = count($listSecond);

    while ($pointerFirst < $countFirst && $pointerSecond < $countSecond) {
        $currentValueFirst = $listFirst[$pointerFirst];
        $currentValueSecond = $listSecond[$pointerSecond];
        if ($currentValueFirst === $currentValueSecond) {
            $result[] = $currentValueFirst;
            $pointerFirst++;
            $pointerSecond++;
            continue;
        }

        $currentValueFirst > $currentValueSecond
            ? $pointerSecond++
            : $pointerFirst++;
    }

    return $result;
}

/**
 * @param non-empty-list<non-negative-int> $listFirst
 * @param non-empty-list<non-negative-int> $listSecond
 * @return list<non-negative-int>
 */
function list_intersection_reverse(array $listFirst, array $listSecond): array
{
    $result = [];

    $pointerFirst = count($listFirst) - 1;
    $pointerSecond = count($listSecond) - 1;
    while ($pointerFirst >= 0 && $pointerSecond >= 0) {
        $currentValueFirst = $listFirst[$pointerFirst];
        $currentValueSecond = $listSecond[$pointerSecond];
        if ($currentValueFirst === $currentValueSecond) {
            $result[] = $currentValueFirst;
            $pointerFirst--;
            $pointerSecond--;
            continue;
        }

        $currentValueFirst > $currentValueSecond
            ? $pointerFirst--
            : $pointerSecond--;
    }

    return array_reverse($result);
}

/**
 * @param non-empty-list<non-negative-int> $list
 * @return list<non-negative-int>
 */
function remove_duplicates(array $list): array
{
    $pointer = count($list) - 1;
    while ($pointer > 0) {
        $valueLeft = $list[$pointer];
        $valueRight = $list[$pointer - 1];
        if ($valueLeft === $valueRight) {
            unset($list[$pointer]);
        }

        $pointer--;
    }

    return array_values($list);
}

/**
 * @param non-empty-list<non-negative-int> $list
 * @return list<non-negative-int>
 */
function remove_duplicates_with_copy(array $list): array
{
    $result = [];
    $pointer = count($list) - 1;
    while ($pointer > 0) {
        $valueLeft = $list[$pointer];
        $valueRight = $list[$pointer - 1];
        if ($valueLeft !== $valueRight) {
            $result[] = $valueLeft;
        }

        $pointer--;
        if ($pointer === 0) {
            $result[] = $list[$pointer];
        }
    }

    return array_reverse($result);
}

/**
 * @param non-empty-list<non-negative-int> $list
 * @param positive-int $sum
 * @return array<non-negative-int, non-negative-int>
 */
function get_indexes_by_sum(array $list, int $sum): array
{
    $pointerLeft = 0;
    $pointerRight = count($list) - 1;

    while ($pointerLeft < $pointerRight) {
        $valueLeft = $list[$pointerLeft];
        $valueRight = $list[$pointerRight];

        $valueSum = $valueLeft + $valueRight;
        if ($valueSum === $sum) {
            return [$pointerLeft, $pointerRight];
        }

        $valueSum > $sum
            ? $pointerRight--
            : $pointerLeft++;
    }

    return [];
}

/**
 * @param non-empty-list<non-negative-int> $list
 * @param positive-int $target
 * @param ?non-negative-int $pointerLeft
 * @param ?non-negative-int $pointerRight
 * @return array<non-negative-int, non-negative-int>
 */
function get_indexes_by_sum_recursive(
    array $list,
    int $target,
    ?int $pointerLeft = null,
    ?int $pointerRight = null
): array {
    $pointerLeft ??= 0;
    $pointerRight ??= count($list) - 1;

    $valueLeft = $list[$pointerLeft];
    $valueRight = $list[$pointerRight];
    $valueSum = $valueLeft + $valueRight;
    if ($valueSum === $target) {
        return [$pointerLeft, $pointerRight];
    }

    $valueSum > $target
        ? $pointerRight--
        : $pointerLeft++;

    if ($pointerLeft >= $pointerRight) {
        return [];
    }

    return get_indexes_by_sum_recursive($list, $target, $pointerLeft, $pointerRight);
}
