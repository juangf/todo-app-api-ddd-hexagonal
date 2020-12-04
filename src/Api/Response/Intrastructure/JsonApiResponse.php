<?php

declare(strict_types=1);

namespace App\Api\Response\Intrastructure;

use App\Api\Response\Domain\ApiResponse;

final class JsonApiResponse implements ApiResponse {
    private $response;
    private $headers;
    private $code;

    function __construct(array $response, int $code = 200)
    {
        $this->response = $response;
        $this->headers = [
            'Content-Type' => 'application/json'
        ];
        $this->code = $code;
    }

    public function content(): string
    {
        return json_encode($this->response);
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function code(): int
    {
        return $this->code;
    }
}