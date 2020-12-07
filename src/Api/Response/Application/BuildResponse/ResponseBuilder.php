<?php

declare(strict_types=1);

namespace App\Api\Response\Application\BuildResponse;

use App\Api\Response\Domain\ApiResponse;
use App\Api\Response\Domain\FormattedApiResponse;
use App\Api\Response\Intrastructure\JsonApiResponse;
use App\Api\Response\Intrastructure\XmlApiResponse;
use RuntimeException;

final class ResponseBuilder
{
    public function execute(ApiResponse $apiResponse, string $format): FormattedApiResponse
    {
        //return new XmlApiResponse($apiResponse, 200);
        if ($format === FormattedApiResponse::JSON_RESPONSE) {
            return new JsonApiResponse($apiResponse, 200);
        } elseif ($format === FormattedApiResponse::XML_RESPONSE) {
            return new XmlApiResponse($apiResponse, 200);
        }
        
        throw new RuntimeException('Unknown response format.');
    }
}