<?php

declare(strict_types=1);

namespace App\Api\Response\Application\BuildResponse;

use App\Api\Response\Application\BuildResponse\ResponseBuilder;
use App\Api\Response\Domain\FormattedApiResponse;

final class BuildResponseCommandHandler
{
    private $builder;

    public function __construct(ResponseBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function __invoke(BuildResponseCommand $command): FormattedApiResponse
    {
        return $this->builder->execute($command->getApiReponse(), $command->getFormat());
    }
}