<?php

declare(strict_types=1);

namespace App\Api\Task\Domain;

use App\Api\Task\Domain\Task;
use App\Api\Task\Domain\ValueObject\TaskId;

interface TaskRepository {
    public function searchAll(): array;
    public function findById(TaskId $id): Task;
    public function save(Task $task): void;
}
