<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\LinkedList;

use Stringable;
use OutOfRangeException;

final class Queue implements Stringable
{
    private ?Node $head = null;
    private ?Node $tail = null;

    /**
     * @var non-negative-int
     */
    private int $length;

    /**
     * @var positive-int
     */
    private int $capacity;

    /**
     * @param positive-int $size
     */
    public function __construct(int $size)
    {
        $this->length = 0;
        $this->capacity = $size;
    }

    public function enqueue(int $value): void
    {
        $node = new Node($value);
        // new list
        if ($this->head === null) {
            $this->head = $node;
            $this->length = 1;
            return;
        }

        $this->pushNode($node);
    }

    /**
     * @throws OutOfRangeException
     */
    public function dequeue(): int
    {
        $node = $this->head;
        if ($node === null) {
            throw new OutOfRangeException('Queue is empty.');
        }

        return $this->shiftHead($node);
    }

    /**
     * @throws OutOfRangeException
     */
    public function peek(): int
    {
        $node = $this->head;
        if ($node === null) {
            throw new OutOfRangeException('Queue is empty.');
        }

        return $node->getValue();
    }

    public function __toString(): string
    {
        $node = $this->head;
        if ($node === null) {
            return '<empty>';
        }

        return (string)$node;
    }

    private function pushNode(Node $node): void
    {
        $this->length++;
        if ($this->length > $this->capacity) {
            $this->head = $this->head?->next;
        }

        $current = $this->tail ?? $this->head;
        if ($current instanceof Node) {
            $current->next = $node;
        }

        $this->tail = $node;
    }

    private function shiftHead(Node $node): int
    {
        $this->length = max(0, $this->length - 1);

        if ($node->next instanceof Node) {
            $this->head = $node->next;
            if ($this->tail === $this->head) {
                $this->tail = null;
            }
        } else {
            $this->head = null;
            $this->tail = null;
        }

        return $node->getValue();
    }
}
