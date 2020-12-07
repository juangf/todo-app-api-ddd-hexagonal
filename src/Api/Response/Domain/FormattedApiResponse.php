<?php

declare(strict_types=1);

namespace App\Api\Response\Domain;

interface FormattedApiResponse {
    public const JSON_RESPONSE = 'json';
    public const XML_RESPONSE = 'xml';

    public function content(): string;
    public function headers(): array;
    public function code(): int;
}