<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Api\Task\Application\SearchAll\SearchAllTasksQuery;
use App\Api\Task\Application\SearchAll\SearchAllTasksQueryHandler;
use App\Api\Task\Application\FindById\FindByIdQuery;
use App\Api\Task\Application\FindById\FindByIdQueryHandler;
use App\Api\Task\Domain\ValueObject\TaskId;
use App\Api\Response\Domain\ApiResponse;
use RuntimeException;

class TaskController extends AbstractApiController
{
    public function searchAll(SearchAllTasksQueryHandler $handler, Request $request): Response
    {
        $response = $handler(new SearchAllTasksQuery());

        $result = array_map(function($t) {
            return [
                'id'   => $t->id(),
                'name' => $t->name(),
                'links' => [
                    [
                        'href' => $this->generateUrl('task', ['id' => $t->id()]),
                        'rel'  => 'self'
                    ]
                ]
            ];
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

        return $this->buildResponse([
            'id'    => $taskResponse->id(),
            'name'  => $taskResponse->name(),
            'links' => [
                [
                    'href' => $this->generateUrl('task', ['id' => $taskResponse->id()]),
                    'rel'  => 'self'
                ]
            ]
        ]);
    }
}
