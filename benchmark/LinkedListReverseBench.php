<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\benchmarks;

use PhpBench\Attributes\Groups;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;
use kuaukutsu\ec\algo\LinkedList\Node;

use function kuaukutsu\ec\algo\LinkedList\generate;
use function kuaukutsu\ec\algo\LinkedList\list_reverse;
use function kuaukutsu\ec\algo\LinkedList\list_reverse_from_array;
use function kuaukutsu\ec\algo\LinkedList\list_reverse_recursive;

#[Revs(1000)]
#[Iterations(10)]
#[Groups(['reverse', 'linked-list'])]
final class LinkedListReverseBench
{
    private Node $list;

    public function __construct()
    {
        $this->list = generate(1, 1000);
    }

    public function benchAsWhile(): int
    {
        return list_reverse($this->list)->getValue();
    }

    public function benchAsArray(): int
    {
        return list_reverse_from_array($this->list)->getValue();
    }

    public function benchAsRecursive(): int
    {
        return list_reverse_recursive($this->list)->getValue();
    }
}
