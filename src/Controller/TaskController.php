<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use App\Api\Task\Application\SearchAll\SearchAllTasksQuery;
use App\Api\Task\Application\SearchAll\SearchAllTasksQueryHandler;

class TaskController extends AbstractController
{
    public function getAll(SearchAllTasksQueryHandler $handler, Request $request): JsonResponse
    {
        $response = $handler(new SearchAllTasksQuery());

        $result = array_map(function($t)  {
            return [
                'id'   => $t->id(),
                'name' => $t->name()
            ];
        }, $response->tasks());

        return $this->json([
            'tasks' => $result
        ]);
    }
}
