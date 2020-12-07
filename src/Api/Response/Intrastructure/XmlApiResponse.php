<?php

declare(strict_types=1);

namespace App\Api\Response\Intrastructure;

use App\Api\Response\Domain\FormattedApiResponse;
use App\Api\Response\Domain\ApiResponse;
use App\Api\Response\Domain\ApiResponseItem;
use SimpleXMLElement;

final class XmlApiResponse implements FormattedApiResponse {
    private $apiResponse;
    private $headers;
    private $code;

    function __construct(ApiResponse $apiResponse, int $code = 200)
    {
        $this->apiResponse = $apiResponse;
        $this->headers = [
            'Content-Type' => 'application/xml'
        ];
        $this->code = $code;
    }

    private function prepareItem(SimpleXMLElement &$xml, ApiResponseItem $responseItem): void
    {
        $properties = $responseItem->getProperties();
        $xmlNode = $xml->addChild($responseItem->getNodeName());
        foreach ($properties as $property) {
            $xmlNode->addChild($property->getName(), $property->getValue());
        }
        
        $links = $responseItem->getLinks();
        if (!empty($links)) {
            $linksNode = $xmlNode->addChild('links');
        }
         
        foreach ($links as $link) {
            $linkChild = $linksNode->addChild('link');
            $linkChild->addAttribute('url', $link->getUrl());
            $linkChild->addAttribute('rel', $link->getRel());
        }

        $items = $responseItem->getItems();
        foreach ($items as $item) {
            $this->prepareItem($xmlNode, $item);
        }
    }

    public function content(): string
    {
        $items = $this->apiResponse->getItems();
        $xml = new SimpleXMLElement('<response/>');
        
        foreach ($items as $item) {
            $this->prepareItem($xml, $item);
        }

        return $xml->asXML();
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