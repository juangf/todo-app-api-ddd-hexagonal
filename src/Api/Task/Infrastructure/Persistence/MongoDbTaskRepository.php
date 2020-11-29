<?php

declare(strict_types=1);

namespace App\Api\Task\Infrastructure\Persistence;

use App\Api\Task\Domain\Task;
use App\Api\Task\Domain\TaskRepository;

final class MongoDbTaskRepository implements TaskRepository
{
    public function searchAll(): array
    {
        return [];
    }

    public function save(Task $task): void
    {
        
    }
}