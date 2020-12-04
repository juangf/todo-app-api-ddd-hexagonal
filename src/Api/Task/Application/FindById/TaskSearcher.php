<?php

declare(strict_types=1);

namespace App\Api\Task\Application\FindById;

use App\Api\Task\Domain\TaskRepository;
use App\Api\Task\Application\TaskResponse;
use App\Api\Task\Domain\ValueObject\TaskId;

final class TaskSearcher
{
    private $repository; 

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search(TaskId $id): TaskResponse
    {
        $task = $this->repository->findById($id);
        return new TaskResponse($task->getId(), $task->getName());
    }

}