<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Service\Http\Logger\Data\HttpLogFilter;
use App\Service\Http\Logger\HttpLogManager;
use App\Service\Http\Logger\RequestLogger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/', name: 'admin_http-log_')]
class HttpLogController extends AbstractController
{
    /**
     * Get list of logged http-requests
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Service\Http\Logger\HttpLogManager $httpLogManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Route('http-log', name: 'list', methods: ['GET'])]
    public function getList(Request $request, HttpLogManager $httpLogManager): Response
    {
        $filters = new HttpLogFilter();
        if ($page = $request->get('page', 1)) {
            $filters->setPage((int)$page);
        }
        if ($itemsPerPage = $request->get('per_page', 10)) {
            $filters->setItemsPerPage((int)$itemsPerPage);
        }
        if ($ip = $request->get('ip')) {
            $filters->setIp($ip);
        }

        $list = $httpLogManager->getRequestList($filters);

        return $this->render('admin/http_log/list.html.twig', [
            'filters' => $filters,
            'list' => $list,
        ]);
    }
}