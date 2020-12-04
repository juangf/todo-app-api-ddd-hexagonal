<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Api\Task\Application\SearchAll\SearchAllTasksQuery;
use App\Api\Task\Application\SearchAll\SearchAllTasksQueryHandler;
use App\Api\Task\Application\FindById\FindByIdQuery;
use App\Api\Task\Application\FindById\FindByIdQueryHandler;
use App\Api\Task\Application\TaskResponse;
use App\Api\Task\Domain\ValueObject\TaskId;
use RuntimeException;

class TaskController extends AbstractApiController
{
    private function taskResponseToArrayModel(TaskResponse $taskResponse): array
    {
        return [
            'id'   => $taskResponse->id(),
            'name' => $taskResponse->name(),
            'links' => [
                [
                    'href' => $this->generateUrl('task', ['id' => $taskResponse->id()]),
                    'rel'  => 'self'
                ]
            ]
        ];
    }

    public function searchAll(SearchAllTasksQueryHandler $handler, Request $request): Response
    {
        $response = $handler(new SearchAllTasksQuery());

        $result = array_map(function(TaskResponse $taskResponse) {
            return $this->taskResponseToArrayModel($taskResponse);
        }, $response->tasks());

        return $this->buildResponse($result);
    }

    public function findById(FindByIdQueryHandler $handler, string $id): Response
    {
        try {
            $taskResponse = $handler(new FindByIdQuery(new TaskId($id)));
        } catch (RuntimeException $e) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return $this->buildResponse($this->taskResponseToArrayModel($taskResponse));
    }
}
