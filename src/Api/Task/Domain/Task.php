<?php

declare(strict_types=1);

namespace App\Api\Task\Domain;

use App\Api\Task\Domain\ValueObject\TaskName;

class Task {
    private $name;

    function __construct(TaskName $name)
    {
        $this->name = $name;
    }
}