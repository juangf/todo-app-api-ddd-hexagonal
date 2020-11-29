<?php

declare(strict_types=1);

namespace App\Api\Task\Domain;

use App\Api\Task\Domain\ValueObject\TaskId;
use App\Api\Task\Domain\ValueObject\TaskName;

class Task {
    private $id;
    private $name;

    function __construct(TaskId $id, TaskName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function createFromPrimitives(string $id, string $name): self
    {
        return new self(
            new TaskId($id),
            new TaskName($name)
        );
    }

    public function getId()
    {
        return $this->id->value();
    }

    public function getName()
    {
        return $this->name->value();
    }
}