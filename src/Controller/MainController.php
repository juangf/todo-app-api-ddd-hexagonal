<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends AbstractController
{
    public function main(): JsonResponse
    {
        $mainLinks = [
            [
                'href' => $this->generateUrl('tasks'),
                'rel' => 'tasks'
            ]
        ];

        return $this->json([
            'links' => $mainLinks
        ]);
    }
}
