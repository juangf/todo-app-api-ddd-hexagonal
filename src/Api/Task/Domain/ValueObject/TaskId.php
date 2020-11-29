<?php

declare(strict_types=1);

namespace App\Api\Task\Domain\ValueObject;

use App\Api\Task\Domain\Exception\InvalidIdException;

class TaskId {
    private $id;

    function __construct(string $id)
    {
        $this->validate($id);
        $this->id = $id;
    }

    private function validate(string $id): void
    {
        if (mb_strlen(trim($id)) === 0) {
            throw new InvalidIdException('Invalid task ID.');
        }
    }

    public function value(): string
    {
        return $this->id;
    }
}