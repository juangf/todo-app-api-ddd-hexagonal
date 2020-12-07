<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Api\Response\Application\BuildResponse\BuildResponseCommand;
use App\Api\Response\Application\BuildResponse\BuildResponseCommandHandler;
use App\Api\Response\Domain\ApiResponse;
use App\Api\Response\Domain\FormattedApiResponse;

abstract class AbstractApiController extends AbstractController
{
    protected $responseCommandHandler;
    protected $apiResponse;
    protected $request;

    function __construct(BuildResponseCommandHandler $responseCommandHandler, ApiResponse $apiResponse, RequestStack $requestStack)
    {
        $this->responseCommandHandler = $responseCommandHandler;
        $this->apiResponse = $apiResponse;
        $this->request = $requestStack->getCurrentRequest();
    }

    function buildResponse(): Response
    {
        $format = $this->request->get('format', FormattedApiResponse::JSON_RESPONSE);
        
        $command = new BuildResponseCommand($this->apiResponse, $format);
        $formattedResponse = ($this->responseCommandHandler)($command);

        return new Response(
            $formattedResponse->content(),
            $formattedResponse->code(), 
            $formattedResponse->headers()
        );
    }
}