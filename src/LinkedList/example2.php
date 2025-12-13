<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\LinkedList;

require dirname(__DIR__) . '/bootstrap.php';

/**
 * Разворот односвязного списка
 *
 * Дан односвязный список, содержащий последовательность чисел.
 * Необходимо реализовать метод reverse(), который изменяет порядок элементов в списке на обратный
 * без использования дополнительных массивов или встроенных функций для работы с коллекциями.
 *
 * Пример:
 * Исходный список: 1 → 2 → 3 → 4
 * Результат: 4 → 3 → 2 → 1
 */

echo 'Разворот односвязного списка' . PHP_EOL;

$list = generate(1, 15);
echo sprintf(
        "List: %s\n"
        . "Reverse (while): %s\n"
        . "Reverse (recursive): %s\n"
        . "Reverse (from array): %s",
        $list,
        list_reverse(clone $list),
        list_reverse_recursive(clone $list),
        list_reverse_from_array(clone $list),
    ) . PHP_EOL . PHP_EOL;

$list = generate(1, 1);
echo sprintf(
        "List: %s\n"
        . "Reverse (while): %s\n"
        . "Reverse (recursive): %s\n"
        . "Reverse (from array): %s",
        $list,
        list_reverse(clone $list),
        list_reverse_recursive(clone $list),
        list_reverse_from_array(clone $list),
    ) . PHP_EOL . PHP_EOL;
