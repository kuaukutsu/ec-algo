<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\LinkedList;

require dirname(__DIR__) . '/bootstrap.php';

/**
 * Объединение двух отсортированных списков
 *
 * Дано: два отсортированных по возрастанию односвязных списка.
 * Нужно написать функцию mergeSortedLists($listA, $listB), которая объединит их в один новый связный список,
 * также отсортированный по возрастанию.
 *
 * Функция не должна использовать массивы или другие контейнеры — только работу со ссылками узлов.
 */

echo 'Объединение двух отсортированных списков' . PHP_EOL;

$listLeft = generate_by_value_step(1, 5, 2);
$listRight = generate_by_value_step(2, 5, 4);
echo sprintf(
        "List Left: %s\n"
        . "List Right: %s\n"
        . "Merge (while): %s\n"
        . "Merge (recursive): %s\n"
        . "Merge (equal): %s",
        $listLeft,
        $listRight,
        list_merge(clone $listLeft, clone $listRight),
        list_merge_recursive(clone $listLeft, clone $listRight),
        list_merge(clone $listLeft, clone $listLeft),
    ) . PHP_EOL . PHP_EOL;
