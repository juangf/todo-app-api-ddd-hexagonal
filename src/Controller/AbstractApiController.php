<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Api\Response\Application\BuildResponse\BuildResponseCommand;
use App\Api\Response\Application\BuildResponse\BuildResponseCommandHandler;

abstract class AbstractApiController extends AbstractController
{
    protected $responseCommandHandler;

    function __construct(BuildResponseCommandHandler $responseCommandHandler)
    {
        $this->responseCommandHandler = $responseCommandHandler;
    }

    function buildResponse(array $data): Response
    {
        $command = new BuildResponseCommand($data);
        $apiResponse = ($this->responseCommandHandler)($command);

        return new Response(
            $apiResponse->content(),
            $apiResponse->code(), 
            $apiResponse->headers()
        );
    }
}