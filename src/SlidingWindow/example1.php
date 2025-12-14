<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\SlidingWindow;

require dirname(__DIR__) . '/bootstrap.php';

/**
 * Нахождение максимальной суммы подмассива фиксированной длины.
 *
 * Есть массив целых чисел и число k.
 * Нужно найти максимальную сумму элементов среди всех подотрезков массива длины ровно k.
 */

echo 'Нахождение максимальной суммы подмассива фиксированной длины.' . PHP_EOL;

$lengthSlice = 3;
$nums = generate(15, 10);
$slice = find_slice_max_sum($nums, $lengthSlice);
echo sprintf(
        "list: [%s]\n"
        . "length slice: %d\n"
        . "slice: [%s]\n"
        . "sum: %d",
        implode(', ', $nums),
        $lengthSlice,
        implode(', ', $slice),
        array_sum($slice)
    ) . PHP_EOL . PHP_EOL;
