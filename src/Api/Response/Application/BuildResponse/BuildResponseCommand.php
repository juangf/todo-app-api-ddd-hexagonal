<?php

declare(strict_types=1);

namespace App\Api\Response\Application\BuildResponse;

use App\Api\Response\Domain\ApiResponse;

final class BuildResponseCommand
{
    private $data;
    private $responseFormat;

    function __construct(array $data, string $responseFormat = ApiResponse::JSON_RESPONSE)
    {
        $this->data = $data;
        $this->responseFormat = $responseFormat;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getResponseFormat(): string
    {
        return $this->responseFormat;
    }
}