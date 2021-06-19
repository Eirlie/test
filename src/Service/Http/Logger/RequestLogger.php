<?php

declare(strict_types=1);

namespace App\Service\Http\Logger;

use App\Entity\HttpLog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestLogger
{
    protected HttpLog $record;

    /**
     * RequestLogger constructor.
     */
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected HttpLogManager $httpLogManager,
    )
    {
        $this->record = new HttpLog();
    }

    /**
     * Log request information to storage
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function logRequestInfo(Request $request): void
    {
        $record = $this->httpLogManager->fillRequestInfo($this->record, $request);
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
        $record = $this->httpLogManager->fillResponseInfo($this->record, $response);
        $this->entityManager->persist($record);
        $this->entityManager->flush();
    }
}