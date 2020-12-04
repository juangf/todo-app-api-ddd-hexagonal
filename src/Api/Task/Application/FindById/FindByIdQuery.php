<?php

declare(strict_types=1);

namespace App\Api\Task\Application\FindById;

use App\Api\Task\Domain\ValueObject\TaskId;

final class FindByIdQuery
{
    private $id;

    function __construct(TaskId $id)
    {
        $this->id = $id;    
    }

    function getId(): TaskId
    {
        return $this->id;
    }
}