<?php

declare(strict_types=1);

namespace App\Api\Response\Domain\ValueObject;

use App\Api\Response\Domain\Exception\InvalidLinkUrlException;

class LinkUrl {
    private $url;

    function __construct(string $url)
    {
        $this->validate($url);
        $this->url = $url;
    }

    private function validate(string $url): void
    {
        if (mb_strlen(trim($url)) === 0) {
            throw new InvalidLinkUrlException('Invalid link url.');
        }
    }

    public function value(): string
    {
        return $this->url;
    }
}