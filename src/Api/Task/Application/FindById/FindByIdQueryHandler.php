<?php

declare(strict_types=1);

namespace App\Api\Task\Application\FindById;

use App\Api\Task\Application\FindById\FindByIdQuery;
use App\Api\Task\Application\FindById\TaskSearcher;
use App\Api\Task\Application\TaskResponse;

final class FindByIdQueryHandler
{
    private $searcher;

    public function __construct(TaskSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(FindByIdQuery $query): TaskResponse
    {
        return $this->searcher->search($query->getId());
    }
}