<?php

declare(strict_types=1);

namespace App\Api\Task\Infrastructure\Persistence;

use App\Api\Task\Domain\Task;
use App\Api\Task\Domain\TaskRepository;
use App\Api\Task\Domain\ValueObject\TaskId;
use RuntimeException;
use InvalidArgumentException;
use MongoDB\Client;
use MongoDB;

final class MongoDbTaskRepository implements TaskRepository
{
    private $connUrl;

    function __construct(string $connUrl)
    {
        $this->connUrl = $connUrl;
    }

    private function getClient(): Client
    {
        $client = new Client($this->connUrl);
        try {
            $dbs = $client->listDatabases();
        }
        catch (RuntimeException $e) {
            throw new RuntimeException('Please check your MongoDB connection host and credentials.');
        }
        return $client;
    }

    public function searchAll(): array
    {
        $client = $this->getClient();

        // Get the all the "task" document collection from the "todo" database
        $collection = $client->todo->task;
        $tasks = $collection->find()->toArray();

        return array_map(function($t) {
            return Task::createFromPrimitives((string)$t->_id, $t->name);
        }, $tasks);
    }

    public function findById(TaskId $id): Task
    {
        $client = $this->getClient();

        $collection = $client->todo->task;

        try {
            $task = $collection->findOne([
                "_id" => new MongoDB\BSON\ObjectId($id->value())
            ]);
        } catch (InvalidArgumentException $e) {
            $task = null;
        }
        
        if ($task === null) {
            throw new RuntimeException(('Task not found.'));
        }

        return Task::createFromPrimitives((string)$task->_id, $task->name);
    }

    public function save(Task $task): void
    {
        
    }
}