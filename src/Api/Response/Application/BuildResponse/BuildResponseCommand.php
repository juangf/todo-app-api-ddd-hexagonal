<?php

declare(strict_types=1);

namespace App\Api\Response\Application\BuildResponse;

use App\Api\Response\Domain\ApiResponse;

final class BuildResponseCommand
{
    private $apiResponse;
    private $format;

    function __construct(ApiResponse $apiResponse, string $format = 'json')
    {
        $this->apiResponse = $apiResponse;
        $this->format = $format;
    }

    public function getApiReponse(): ApiResponse
    {
        return $this->apiResponse;
    }

    public function getFormat(): string
    {
        return $this->format;
    }
}