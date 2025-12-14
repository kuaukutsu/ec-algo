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
 * @param positive-int $length
 * @return non-empty-string
 */
function generate_word(int $length): string
{
    $string = '';
    $num = 0;
    $words = range('a', 'z');
    while ($length > 0) {
        try {
            $canNewPoint = random_int(0, 3) !== 1;
            if ($canNewPoint) {
                $num = random_int(0, 25);
            }
        } catch (Throwable) {
            $num++;
        }

        $string .= $words[$num];
        $length--;
    }

    return $string;
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

/**
 * @param non-empty-string $str
 * @return list<non-empty-string>
 */
function find_largest_slice_all_characters_unique(string $str): array
{
    /**
     * @param non-empty-array<non-empty-string, mixed> $array
     * @param non-empty-string $character
     * @return list<non-empty-string>
     */
    $fnSlice = static function (array $array, string $character): array {
        $list = array_keys($array);
        $position = array_search($character, $list, true);
        if ($position !== false) {
            return array_fill_keys(array_slice($list, $position + 1), 1);
        }

        return $array;
    };

    $slice = [];
    $window = [];

    $len = strlen($str);
    $pointer = 0;
    while ($pointer < $len) {
        $character = $str[$pointer];
        if (($window[$character] ?? 0) === 1) {
            $window = $fnSlice($window, $character);
        }

        $window[$character] = 1;
        if (count($window) > count($slice)) {
            /** @var list<non-empty-string> $slice */
            $slice = array_keys($window);
        }

        $pointer++;
    }

    return $slice;
}

/**
 * @param non-empty-string $str
 * @return list<non-empty-string>
 */
function find_largest_slice_all_characters_unique_fast(string $str): array
{
    $slice = [];
    $list = str_split($str);
    $len = count($list);
    $pointer = 0;
    $left = 0;
    $mapCharacter = [];
    while ($pointer < $len) {
        $character = $str[$pointer];
        $position = $mapCharacter[$character] ?? -1;
        if ($position >= $left) {
            $left = $position + 1;
        }

        $window = array_slice($list, $left, ($pointer - $left + 1));
        if (count($window) > count($slice)) {
            $slice = $window;
        }

        $mapCharacter[$character] = $pointer;
        $pointer++;
    }

    return $slice;
}
