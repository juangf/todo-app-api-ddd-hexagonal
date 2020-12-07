<?php

declare(strict_types=1);

namespace App\Api\Response\Domain;

use App\Api\Response\Domain\ValueObject\NodeName;

class ApiResponseItem {
    private $nodeName;
    private $properties;
    private $links;
    private $items;

    function __construct(NodeName $nodeName)
    {
        $this->nodeName = $nodeName;
        $this->properties = [];
        $this->links = [];
        $this->items = [];
    }

    public function addProperty(Property $property): void
    {
        $this->properties[] = $property;
    }

    public function addLink(Link $link): void
    {
        $this->links[] = $link;
    }

    public function addItem(self $item): void
    {
        $this->items[] = $item;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getLinks(): array
    {
        return $this->links;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getNodeName(): string
    {
        return $this->nodeName->value();
    }
}