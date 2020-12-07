<?php

declare(strict_types=1);

namespace App\Api\Response\Domain\ValueObject;

use App\Api\Response\Domain\Exception\InvalidNodeNameException;

class NodeName {
    private $name;

    function __construct(string $name)
    {
        $this->validate($name);
        $this->name = $name;
    }

    private function validate(string $name): void
    {
        if (mb_strlen(trim($name)) === 0) {
            throw new InvalidNodeNameException('Invalid node name.');
        }
    }

    public function value(): string
    {
        return $this->name;
    }
}