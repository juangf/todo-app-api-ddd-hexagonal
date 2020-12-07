<?php

declare(strict_types=1);

namespace App\Api\Response\Domain;

use App\Api\Response\Domain\ValueObject\LinkRel;
use App\Api\Response\Domain\ValueObject\LinkUrl;

class Link {
    private $url;
    private $rel;

    function __construct(LinkUrl $url, LinkRel $rel)
    {
        $this->url = $url;
        $this->rel = $rel;
    }

    public function getUrl(): string
    {
        return $this->url->value();
    }

    public function getRel(): string
    {
        return $this->rel->value();
    }
}