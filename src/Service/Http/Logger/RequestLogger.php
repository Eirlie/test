<?php

declare(strict_types=1);

namespace App\Service\Http;

use App\Entity\HttpLog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestLogger
{
    protected $record;

    /**
     * RequestLogger constructor.
     */
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    /**
     * Log request information to storage
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function logRequestInfo(Request $request): void
    {
        $record = $this->getRecord();
        $record->setIp($request->getClientIp());
        $record->setUrl($request->getUri());
        $record->setRequestHeaders($request->headers->all());

        $content = $request->getContent();
        if (is_string($content)) {
            $record->setRequest($content);
        }

        $this->entityManager->persist($record);
        $this->entityManager->flush();
    }

    /**
     * Log response information to storage
     *
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    public function logResponseInfo(Response $response): void
    {
        $record = $this->getRecord();

        if ($content = $response->getContent()) {
            $record->setResponse($content);
        }
        $record->setResponseHeaders($response->headers->all());
        $record->setStatusCode($response->getStatusCode());

        $this->entityManager->persist($record);
        $this->entityManager->flush();
    }

    /**
     * Get current request record
     *
     * @return \App\Entity\HttpLog
     */
    protected function getRecord(): HttpLog
    {
        if (!$this->record) {
            $this->record = new HttpLog();
        }

        return $this->record;
    }
}