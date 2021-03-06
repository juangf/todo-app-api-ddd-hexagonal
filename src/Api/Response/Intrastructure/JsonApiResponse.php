<?php

declare(strict_types=1);

namespace App\Api\Response\Intrastructure;

use App\Api\Response\Domain\FormattedApiResponse;
use App\Api\Response\Domain\ApiResponse;
use App\Api\Response\Domain\ApiResponseItem;

final class JsonApiResponse implements FormattedApiResponse {
    private $apiResponse;
    private $headers;
    private $code;

    function __construct(ApiResponse $apiResponse, int $code = 200)
    {
        $this->apiResponse = $apiResponse;
        $this->headers = [
            'Content-Type' => 'application/json'
        ];
        $this->code = $code;
    }

    private function prepareItem(ApiResponseItem $responseItem): array
    {
        $result = [];
        $properties = $responseItem->getProperties();
        foreach ($properties as $property) {
            $result[$property->getName()] = $property->getValue();
        }
        
        $links = $responseItem->getLinks();
        foreach ($links as $link) {
            $result['links'][] = [
                'url' => $link->getUrl(),
                'rel' => $link->getRel()
            ];
        }

        $items = $responseItem->getItems();
        foreach ($items as $item) {
            $result[] = $this->prepareItem($item);
        }

        return $result;
    }

    public function content(): string
    {
        $items = $this->apiResponse->getItems();
        $result = [];

        foreach ($items as $item) {
            $result[$item->getNodeName()] = $this->prepareItem($item);
        }

        return json_encode($result);
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