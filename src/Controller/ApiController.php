<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use App\Api\Task\Domain\TaskRepository;
use App\Api\Task\Application\SearchAllTasks;

class ApiController extends AbstractController
{
    private $taskRepository;

    function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $searcher = new SearchAllTasks($this->taskRepository);

        $tasks = $searcher();

        $result = [];
        foreach ($tasks as $t) {
            $result[] = [
                'id'   => $t->getId(),
                'name' => $t->getName()
            ];
        }

        return $this->json([
            'tasks' => $result
        ]);
    }
}
