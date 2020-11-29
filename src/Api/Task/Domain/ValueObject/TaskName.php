<?php

declare(strict_types=1);

namespace App\Api\Task\Domain\ValueObject;

use App\Api\Task\Domain\Exception\InvalidNameException;

class TaskName {
    private $name;

    function __construct(string $name)
    {
        $this->validate($name);
        $this->name = $name;
    }

    private function validate(string $name): void
    {
        if (mb_strlen(trim($name)) === 0) {
            throw new InvalidNameException('Invalid task name.');
        }
    }


    public function __toString(): string
    {
        return $this->name;
    }
}