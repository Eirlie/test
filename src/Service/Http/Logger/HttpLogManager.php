<?php

declare(strict_types=1);

namespace App\Service\Http\Logger;

use App\Entity\HttpLog;
use App\Repository\HttpLogRepository;
use App\Service\Http\Logger\Data\HttpLogFilter;
use App\Service\View\PaginatedList;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpLogManager
{
    /**
     * HttpLogManager constructor.
     */
    public function __construct(protected HttpLogRepository $httpLogRepository)
    {
    }

    public function getRequestList(HttpLogFilter $filter = null): PaginatedList
    {
        return new PaginatedList(
            $this->httpLogRepository->findByFiltersCount($filter),
            $this->httpLogRepository->findByFilters($filter),
        );
    }

    /**
     * Fill record request information
     *
     * @param \App\Entity\HttpLog $record
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \App\Entity\HttpLog
     */
    public function fillRequestInfo(HttpLog $record, Request $request): HttpLog
    {
        $record->setIp($request->getClientIp());
        $record->setUrl($request->getUri());
        $record->setRequestHeaders((string)$request->headers);

        $content = $request->getContent();
        if (is_string($content)) {
            $record->setRequest($content);
        }

        return $record;
    }

    /**
     * Fill record response information
     *
     * @param \App\Entity\HttpLog $record
     * @param \Symfony\Component\HttpFoundation\Response $response
     *
     * @return \App\Entity\HttpLog
     */
    public function fillResponseInfo(HttpLog $record, Response $response): HttpLog
    {
        if ($content = $response->getContent()) {
            $record->setResponse($content);
        }
        $record->setResponseHeaders((string)$response->headers);
        $record->setStatusCode($response->getStatusCode());

        return $record;
    }
}