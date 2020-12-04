<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use App\Api\Task\Application\SearchAll\SearchAllTasksQuery;
use App\Api\Task\Application\SearchAll\SearchAllTasksQueryHandler;
use App\Api\Task\Application\FindById\FindByIdQuery;
use App\Api\Task\Application\FindById\FindByIdQueryHandler;
use App\Api\Task\Domain\ValueObject\TaskId;
use RuntimeException;

class TaskController extends AbstractController
{
    public function searchAll(SearchAllTasksQueryHandler $handler, Request $request): JsonResponse
    {
        $response = $handler(new SearchAllTasksQuery());

        $result = array_map(function($t) {
            return [
                'id'   => $t->id(),
                'name' => $t->name(),
                'link' => [
                    'href' => $this->generateUrl('task', ['id' => $t->id()]),
                    'rel'  => 'task'
                ]
            ];
        }, $response->tasks());

        return $this->json([
            'tasks' => $result
        ]);
    }

    public function findById(FindByIdQueryHandler $handler, string $id): JsonResponse
    {
        $taskId = new TaskId($id);

        try {
            $response = $handler(new FindByIdQuery($taskId));
        } catch (RuntimeException $e) {
            return $this->json('', JsonResponse::HTTP_NOT_FOUND);
        }

        return $this->json([
            'id'    => $response->id(),
            'name'  => $response->name(),
            'link' => [
                'href' => $this->generateUrl('task', ['id' => $response->id()]),
                'rel'  => 'self'
            ]
        ]);
    }
}
