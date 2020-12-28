<?php

namespace App\Controller;

use App\Service\OffersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OffersApiController
 * @package App\Controller
 */
class OffersApiController extends AbstractController
{
    /**
     * @Route("/api/offers", name="offers_api", methods={"GET"})
     */
    public function getCurrentBatchOfOffers(OffersService $offersService): Response
    {
        $currentBatchOfOffers = $offersService->getCurrentBatchOfOffers();

        return $this->json($currentBatchOfOffers);
    }
}
