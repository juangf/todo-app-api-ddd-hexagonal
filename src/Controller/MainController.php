<?php

declare(strict_types=1);

namespace App\Controller;

use App\Api\Response\Domain\ApiResponse;
use App\Api\Response\Domain\ApiResponseItem;
use App\Api\Response\Domain\Link;
use App\Api\Response\Domain\ValueObject\LinkRel;
use App\Api\Response\Domain\ValueObject\LinkUrl;
use App\Api\Response\Domain\ValueObject\NodeName;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractApiController
{
    public function main(): Response
    {
        $rootItem = new ApiResponseItem(new NodeName('root'));

        $responseItem = new ApiResponseItem(new NodeName('entities'));
        $responseItem->addLink(
            new Link(new LinkUrl($this->generateUrl('tasks')), new LinkRel('tasks'))
        );

        $rootItem->addItem($responseItem);

        $this->apiResponse->addItem($rootItem);

        return $this->buildResponse();
    }
}
