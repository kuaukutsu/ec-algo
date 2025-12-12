<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\LinkedList;

/**
 * @param positive-int $capacity
 */
function generate(int $value, int $capacity, ?Node $node = null): Node
{
    $node ??= new Node($value);

    $value++;
    $capacity--;
    if ($capacity > 0) {
        $node->next = new Node($value);
        generate($value, $capacity, $node->next);
    }

    return $node;
}

/**
 * @param positive-int $capacity
 * @param positive-int $stepValue
 */
function generate_by_value_step(int $value, int $capacity, int $stepValue = 1, ?Node $node = null): Node
{
    $node ??= new Node($value);

    $value += $stepValue;
    $capacity--;
    if ($capacity > 0) {
        $node->next = new Node($value);
        generate_by_value_step($value, $capacity, $stepValue, $node->next);
    }

    return $node;
}

/**
 * @param list<int> $list
 * @param non-negative-int $pointer
 */
function generate_from_array(array $list, int $pointer = 0, ?Node $node = null): Node
{
    $node ??= new Node($list[$pointer]);

    $pointer++;
    if (isset($list[$pointer])) {
        $node->next = new Node($list[$pointer]);
        generate_from_array($list, $pointer, $node->next);
    }

    return $node;
}

function list_reverse(Node $list): Node
{
    $next = $list->next;
    if ($next === null) {
        return $list;
    }

    $node = $list;
    $node->next = null;

    $tail = $node;
    while ($next instanceof Node) {
        // pointer next
        $nodeNext = $next->next;
        // write
        $node = $next;
        $node->next = $tail;
        // moving
        $tail = $node;
        $next = $nodeNext;
    }

    return $node;
}

function list_reverse_recursive(Node $list, ?Node $tail = null): Node
{
    $next = $list->next;
    $list->next = $tail;
    if ($next instanceof Node) {
        return list_reverse_recursive($next, $list);
    }

    return $list;
}

function list_reverse_from_array(Node $list): Node
{
    return generate_from_array(
        array_reverse($list->toArray())
    );
}

function list_merge(Node $listLeft, Node $listRight): Node
{
    $tail = $node = new Node(0);
    while ($listLeft !== null && $listRight !== null) {
        if ($listLeft->getValue() <= $listRight->getValue()) {
            $tail->next = $listLeft;
            $listLeft = $listLeft->next;
        } else {
            $tail->next = $listRight;
            $listRight = $listRight->next;
        }

        $tail = $tail->next;
    }

    $tail->next = $listLeft ?? $listRight;
    return $node->next ?? $node;
}

function list_merge_recursive(Node $listLeft, Node $listRight, ?Node $root = null): Node
{
    $root ??= new Node(0);

    if ($listLeft->getValue() <= $listRight->getValue()) {
        $root->next = $listLeft;
        if ($listLeft->next instanceof Node) {
            list_merge_recursive($listLeft->next, $listRight, $root->next);
        } else {
            $root->next->next = $listRight;
        }
    } else {
        $root->next = $listRight;
        if ($listRight->next instanceof Node) {
            list_merge_recursive($listLeft, $listRight->next, $root->next);
        } else {
            $root->next->next = $listLeft;
        }
    }

    return $root->next;
}
