<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\SlidingWindow;

require dirname(__DIR__) . '/bootstrap.php';

/**
 * Дана строка s, нужно найти длину самой длинной подстроки без повторяющихся символов.
 *
 * Дана строка s, состоящая из английских букв.
 * Найти длину наибольшей непрерывной подстроки, в которой все символы уникальны (не повторяются).
 */

echo 'Найти длину наибольшей непрерывной подстроки, в которой все символы уникальны.' . PHP_EOL;

$str = generate_word(10);
$slice = find_largest_slice_all_characters_unique($str);
$sliceFast = find_largest_slice_all_characters_unique_fast($str);
echo sprintf(
        "list: '%s'\n"
        . "count: %d\n"
        . "count (fast): %d\n"
        . "count (verify): %d\n"
        . "slice: [%s]\n"
        . "slice (fast): [%s]\n",
        $str,
        count($slice),
        count($sliceFast),
        count(array_unique($slice)),
        implode(', ', $slice),
        implode(', ', $sliceFast),
    ) . PHP_EOL . PHP_EOL;
