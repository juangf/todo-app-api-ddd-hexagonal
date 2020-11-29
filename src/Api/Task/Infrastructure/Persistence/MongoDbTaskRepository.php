<?php

declare(strict_types=1);

namespace App\Api\Task\Infrastructure\Persistence;

use App\Api\Task\Domain\Task;
use App\Api\Task\Domain\TaskRepository;
use RuntimeException;
use MongoDB\Client;

final class MongoDbTaskRepository implements TaskRepository
{
    private $connUrl;

    function __construct(array $arguments)
    {
        $this->connUrl = $arguments['databaseUrl'];
    }

    private function getClient(): ?Client
    {
        $client = new Client($this->connUrl);
        try {
            $dbs = $client->listDatabases();
        }
        catch (RuntimeException $e) {
            return null;
        }
        return $client;
    }

    public function searchAll(): array
    {
        $client = $this->getClient();

        // Get the all the "task" document collection from the "todo" database
        $collection = $client->todo->task;
        $tasks = $collection->find()->toArray();

        $result = [];
        foreach ($tasks as $t) {
            $result[] = Task::createFromPrimitives((string)$t->_id, $t->name);
        }
        return $result;
    }

    public function save(Task $task): void
    {
        
    }
}