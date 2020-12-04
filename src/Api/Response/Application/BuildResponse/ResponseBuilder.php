<?php

declare(strict_types=1);

namespace App\Api\Response\Application\BuildResponse;

use App\Api\Response\Domain\ApiResponse;
use App\Api\Response\Intrastructure\JsonApiResponse;
use RuntimeException;

final class ResponseBuilder
{
    public function execute(array $data, string $responseFormat): ApiResponse
    {
        if ($responseFormat === ApiResponse::JSON_RESPONSE) {
            return new JsonApiResponse($data);
        }
        
        throw new RuntimeException('Unknown response format.');
    }
}