<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\SlidingWindow;

require dirname(__DIR__) . '/bootstrap.php';

/**
 * Поиск длинейшего подотрезка, удовлетворяющего ограничению.
 *
 * Дан массив неотрицательных чисел и число S.
 * Нужно найти максимальную длину подмассива с суммой, не превосходящей S.
 */

echo 'Поиск длинейшего подотрезка, удовлетворяющего ограничению.' . PHP_EOL;

$list = generate(15, 10);
$limitSum = max(1, max($list));
$slice = find_slice_max_length_less_than_sum($list, $limitSum);
echo sprintf(
        "list: [%s]\n"
        . "limit sum: %d\n"
        . "slice: [%s]\n"
        . "sum: %d",
        implode(', ', $list),
        $limitSum,
        implode(', ', $slice),
        array_sum($slice)
    ) . PHP_EOL . PHP_EOL;
