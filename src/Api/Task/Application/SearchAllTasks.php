<?php

declare(strict_types=1);

namespace App\Api\Task\Application;
use App\Api\Task\Domain\TaskRepository;

final class SearchAllTasks
{
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->searchAll();
    }
}