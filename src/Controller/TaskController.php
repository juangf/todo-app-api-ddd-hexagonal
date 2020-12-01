<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use App\Api\Task\Application\SearchAllTasks;

class TaskController extends AbstractController
{
    public function getAll(SearchAllTasks $searchAllTasks, Request $request): JsonResponse
    {
        $tasks = $searchAllTasks();

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
