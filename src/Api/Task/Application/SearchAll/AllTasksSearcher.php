<?php

declare(strict_types=1);

namespace App\Api\Task\Application\SearchAll;

use App\Api\Task\Domain\Task;
use App\Api\Task\Domain\TaskRepository;
use App\Api\Task\Application\TaskResponse;
use App\Api\Task\Application\TasksResponse;

final class AllTasksSearcher
{
    private $repository; 

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }
    
    private function toTaskResponse(): callable
    {
        return function(Task $task) {
            return new TaskResponse(
                $task->getId(),
                $task->getName()
            );
        };
    }

    public function search(): TasksResponse
    {
        return new TasksResponse(array_map($this->toTaskResponse(), $this->repository->searchAll()));
    }

}