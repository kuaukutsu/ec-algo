<?php

declare(strict_types=1);

namespace kuaukutsu\ec\algo\LinkedList;

use OutOfRangeException;

require dirname(__DIR__) . '/bootstrap.php';

/**
 * Реализация очереди с ограничением размера
 *
 * Реализуйте структуру данных «очередь» (Queue) на основе односвязного списка.
 * Очередь должна иметь следующие характеристики:
 *  - Максимальная длина очереди задаётся при создании.
 *  - При добавлении нового элемента, если очередь заполнена, автоматически удаляется элемент из начала списка.
 */

echo 'Реализация очереди с ограничением размера' . PHP_EOL;

$queue = new Queue(4);
echo "Queue(4): " . $queue . PHP_EOL;

$queue->enqueue(1);
$queue->enqueue(2);
echo "enqueue: [1, 2]\nQueue(4): " . $queue . PHP_EOL . PHP_EOL;

echo sprintf(
        "peek:\n"
        . "\$queue->peek(): %d\n"
        . "\$queue->peek(): %d",
        $queue->peek(),
        $queue->peek()
    )
    . PHP_EOL . PHP_EOL;

$queue->enqueue(3);
$queue->enqueue(4);
$queue->enqueue(5);
echo "enqueue: [3, 4, 5]\nQueue(4): " . $queue . PHP_EOL . PHP_EOL;

echo sprintf(
        "dequeue:\n"
        . "\$queue->dequeue(): %d\n"
        . "\$queue->dequeue(): %d\n"
        . "Queue(4): %s",
        $queue->dequeue(),
        $queue->dequeue(),
        $queue
    ) . PHP_EOL . PHP_EOL;

$queue->enqueue(6);
$queue->enqueue(7);
echo "enqueue: [6, 7]\nQueue(4): " . $queue . PHP_EOL . PHP_EOL;
echo sprintf(
        "peek:\n"
        . "\$queue->peek(): %d\n"
        . "\$queue->peek(): %d",
        $queue->peek(),
        $queue->peek()
    )
    . PHP_EOL . PHP_EOL;

echo sprintf(
        "dequeue:\n"
        . "\$queue->dequeue(): %d\n"
        . "\$queue->dequeue(): %d\n"
        . "\$queue->dequeue(): %d\n"
        . "Queue(4): %s",
        $queue->dequeue(),
        $queue->dequeue(),
        $queue->dequeue(),
        $queue
    )
    . PHP_EOL . PHP_EOL;

try {
    $queue->dequeue();
} catch (OutOfRangeException $exception) {
    echo sprintf(
            "dequeue:\n"
            . "\$queue->dequeue(): %s",
            $exception->getMessage()
        )
        . PHP_EOL . PHP_EOL;
}
