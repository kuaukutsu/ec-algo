<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\TwoPointers;

require dirname(__DIR__) . '/bootstrap.php';

/**
 * Условие:
 * Дан отсортированный массив nums.
 * Необходимо удалить все повторяющиеся элементы на месте, чтобы каждый элемент встречался только один раз,
 * и вернуть новую длину массива.
 */

echo "Необходимо удалить все повторяющиеся элементы." . PHP_EOL;

$nums = get_list_number(1, 10);
echo sprintf(
        "nums: [%s]\n"
        . "check inner func: [%s]\n"
        . "without duplicates: [%s]\n"
        . "without duplicates (copy): [%s]",
        implode(', ', $nums),
        implode(', ', array_unique($nums)),
        implode(', ', remove_duplicates($nums)),
        implode(', ', remove_duplicates_with_copy($nums)),
    ) . PHP_EOL . PHP_EOL;


