<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\LinkedList;

use Stringable;

final class Node implements Stringable
{
    public ?Node $next = null;

    private int $value;

    public function __construct(int $value, ?Node $next = null)
    {
        $this->value = $value;
        $this->next = $next;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return list<int>
     */
    public function toArray(): array
    {
        if ($this->next instanceof self) {
            return [$this->value, ...$this->next->toArray()];
        }

        return [$this->value];
    }

    public function __clone(): void
    {
        if ($this->next instanceof self) {
            $this->next = clone $this->next;
        }
    }

    public function __toString(): string
    {
        return implode(' → ', $this->toArray());
    }
}
