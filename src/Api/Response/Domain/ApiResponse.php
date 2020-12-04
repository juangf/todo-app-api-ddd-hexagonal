<?php

declare(strict_types=1);

namespace App\Api\Response\Domain;

interface ApiResponse {
    public const JSON_RESPONSE = 'json';

    public function content(): string;
    public function headers(): array;
    public function code(): int;
}