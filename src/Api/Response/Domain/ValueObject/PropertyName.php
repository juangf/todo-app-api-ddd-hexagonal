<?php

declare(strict_types=1);

namespace App\Api\Response\Domain\ValueObject;

use App\Api\Response\Domain\Exception\InvalidPropertyNameException;

class PropertyName {
    private $rel;

    function __construct(string $rel)
    {
        $this->validate($rel);
        $this->rel = $rel;
    }

    private function validate(string $rel): void
    {
        if (mb_strlen(trim($rel)) === 0) {
            throw new InvalidPropertyNameException('Invalid property name.');
        }
    }

    public function value(): string
    {
        return $this->rel;
    }
}