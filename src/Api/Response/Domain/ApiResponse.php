<?php

declare(strict_types=1);

namespace App\Api\Response\Domain;

use App\Api\Response\Domain\ValueObject\NodeName;

class ApiResponse {
    private $items;

    function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function addItem(ApiResponseItem $item): void
    {
        $this->items[] = $item;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}