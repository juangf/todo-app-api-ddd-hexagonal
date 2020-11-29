<?php

declare(strict_types=1);

namespace App\Api\Task\Domain;

use App\Api\Task\Domain\Task;

interface TaskRepository {
    public function searchAll(): array;
    public function save(Task $task): void;
}
