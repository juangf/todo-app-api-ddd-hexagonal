<?php

declare(strict_types=1);

namespace App\Api\Response\Domain;

use App\Api\Response\Domain\ValueObject\PropertyName;
use App\Api\Response\Domain\ValueObject\PropertyValue;

class Property {
    private $name;
    private $value;

    function __construct(PropertyName $name, PropertyValue $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name->value();
    }

    public function getValue(): string
    {
        return $this->value->value();
    }
}