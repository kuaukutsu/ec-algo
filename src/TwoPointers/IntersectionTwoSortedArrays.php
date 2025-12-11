<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\TwoPointers;

require dirname(__DIR__) . '/bootstrap.php';

/**
 * Intersection of two sorted arrays
 *
 * Условие:
 * Даны два отсортированных по возрастанию массива целых чисел a и b.
 * Нужно найти их пересечение, то есть все элементы, которые встречаются в обоих массивах.
 * Если элемент встречается несколько раз в обоих массивах, то в результат он должен попасть столько раз,
 * сколько раз он встречается в обоих (минимум из количеств в каждом массиве).
 */

echo "Нужно найти пересечение двух отсортированных по возрастанию массива целых чисел." . PHP_EOL;

$arr1 = get_list_number(0, 10);
$arr2 = get_list_number(1, 12);
echo sprintf(
        "list one: [%s]\n"
        . "list two: [%s]\n"
        . "direct intersection: [%s]\n"
        . "reverse intersection: [%s]",
        implode(', ', $arr1),
        implode(', ', $arr2),
        implode(', ', list_intersection_direct($arr1, $arr2)),
        implode(', ', list_intersection_reverse($arr1, $arr2))
    ) . PHP_EOL . PHP_EOL;
