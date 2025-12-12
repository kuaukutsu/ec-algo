<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\TwoPointers;

require dirname(__DIR__) . '/bootstrap.php';

/**
 * Условие:
 * Дан отсортированный по возрастанию массив целых чисел nums и целое число target.
 * Найти индексы двух чисел, сумма которых равна target.
 * Предполагается, что такая пара существует, и каждое значение может использоваться не более одного раза.
 */

echo "Найти индексы двух чисел, сумма которых равна target." . PHP_EOL;

$nums = generate(1, 15);
[$targetPointLeft, $targetPointRight] = array_rand($nums, 2);
/** @var positive-int $targetSum */
$targetSum = $nums[$targetPointLeft] + $nums[$targetPointRight];

$indexPointers = get_indexes_by_sum($nums, $targetSum);
[$valuePointLeft, $valuePointRight] = $indexPointers;
echo sprintf(
        "nums: [%s]\ntarget: %d\nanswer: %d + %d\n"
        . "while: [%s]\n"
        . "recursive: [%s]\n"
        . "while (negative): [%s]\n"
        . "recursive (negative): [%s]\n",
        implode(', ', $nums),
        $targetSum,
        $nums[$valuePointLeft],
        $nums[$valuePointRight],
        implode(', ', $indexPointers),
        implode(', ', get_indexes_by_sum_recursive($nums, $targetSum)),
        implode(', ', get_indexes_by_sum($nums, $targetSum + 100)),
        implode(', ', get_indexes_by_sum_recursive($nums, $targetSum + 100)),
    ) . PHP_EOL . PHP_EOL;
