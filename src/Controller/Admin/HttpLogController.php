<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Service\Http\RequestLogger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('', name: 'admin_http-log_')]
class HttpLogController extends AbstractController
{
    /**
     * Get list of logged http-requests
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Service\Http\RequestLogger $requestLogger
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Route('http-log', name: 'list', methods: ['GET'])]
    public function getList(Request $request, RequestLogger $requestLogger): Response
    {

    }
}