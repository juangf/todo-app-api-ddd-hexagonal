<?php

declare(strict_types=1);

namespace App\Api\Task\Application;

final class TasksResponse
{
    /**
     * @var array
     */
    private $tasks;

    public function __construct(array $tasks)
    {
        $this->tasks = $tasks;
    }

    public function tasks(): array
    {
        return $this->tasks;
    }
}