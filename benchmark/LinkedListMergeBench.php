<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\benchmarks;

use PhpBench\Attributes\Groups;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;
use kuaukutsu\ec\algo\LinkedList\Node;

use function kuaukutsu\ec\algo\LinkedList\generate_by_value_step;
use function kuaukutsu\ec\algo\LinkedList\list_merge;
use function kuaukutsu\ec\algo\LinkedList\list_merge_recursive;

#[Revs(1000)]
#[Iterations(10)]
#[Groups(['merge', 'linked-list'])]
final class LinkedListMergeBench
{
    private Node $listA;
    private Node $listB;

    public function __construct()
    {
        $this->listA = generate_by_value_step(1, 1000, 2);
        $this->listB = generate_by_value_step(2, 1000, 2);
    }

    public function benchAsWhile(): int
    {
        return list_merge(clone $this->listA, clone $this->listB)->getValue();
    }

    public function benchAsRecursive(): int
    {
        return list_merge_recursive(clone $this->listA, clone $this->listB)->getValue();
    }
}
