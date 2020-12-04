<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractApiController
{
    public function main(): Response
    {
        $mainLinks = [
            [
                'href' => $this->generateUrl('tasks'),
                'rel' => 'tasks'
            ]
        ];

        return $this->buildResponse($mainLinks);
    }
}
