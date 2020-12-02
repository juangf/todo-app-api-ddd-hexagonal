<?php

declare(strict_types=1);

namespace App\Api\Task\Application\SearchAll;
use App\Api\Task\Domain\TaskRepository;

use App\Api\Task\Application\SearchAll\SearchAllTasksQuery;
use App\Api\Task\Application\SearchAll\AllTasksSearcher;
use App\Api\Task\Application\TasksResponse;

final class SearchAllTasksQueryHandler
{
    private $searcher;

    public function __construct(AllTasksSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(SearchAllTasksQuery $query): TasksResponse
    {
        return ($this->searcher)();
    }
}