<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Api\Task\Application\SearchAll\SearchAllTasksQuery;
use App\Api\Task\Application\SearchAll\SearchAllTasksQueryHandler;
use App\Api\Task\Application\FindById\FindByIdQuery;
use App\Api\Task\Application\FindById\FindByIdQueryHandler;
use App\Api\Task\Application\TaskResponse;
use App\Api\Task\Domain\ValueObject\TaskId;

use App\Api\Response\Domain\ApiResponseItem;
use App\Api\Response\Domain\Link;
use App\Api\Response\Domain\Property;
use App\Api\Response\Domain\ValueObject\LinkRel;
use App\Api\Response\Domain\ValueObject\LinkUrl;
use App\Api\Response\Domain\ValueObject\NodeName;
use App\Api\Response\Domain\ValueObject\PropertyName;
use App\Api\Response\Domain\ValueObject\PropertyValue;

use RuntimeException;

class TaskController extends AbstractApiController
{
    private function getTaskResponseItem(TaskResponse $task): ApiResponseItem
    {
        $taskResponseItem = new ApiResponseItem(new NodeName('task'));

        $taskResponseItem->addProperty(
            new Property(new PropertyName('id'), new PropertyValue($task->id()))
        );

        $taskResponseItem->addProperty(
            new Property(new PropertyName('name'), new PropertyValue($task->name()))
        );

        $taskResponseItem->addLink(
            new Link(new LinkUrl($this->generateUrl('task', ['id' => $task->id()])), new LinkRel('self'))
        );

        return $taskResponseItem;
    }

    public function searchAll(SearchAllTasksQueryHandler $handler): Response
    {
        $tasksResponse = $handler(new SearchAllTasksQuery());

        $responseItem = new ApiResponseItem(new NodeName('tasks'));

        $tasks = $tasksResponse->tasks();
        foreach ($tasks as $task) {
            $responseItem->addItem($this->getTaskResponseItem($task));
        }

        $this->apiResponse->addItem($responseItem);

        return $this->buildResponse();
    }

    public function findById(FindByIdQueryHandler $handler, string $id): Response
    {
        try {
            $taskResponse = $handler(new FindByIdQuery(new TaskId($id)));
            $this->apiResponse->addItem($this->getTaskResponseItem($taskResponse));
        } catch (RuntimeException $e) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return $this->buildResponse();
    }
}
