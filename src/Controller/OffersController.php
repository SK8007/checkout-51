<?php

namespace App\Controller;

use App\Service\OffersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffersController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(OffersService $offersService): Response
    {
        $currentBatch = $offersService->getCurrentBatchOfOffers();

        dump($currentBatch);

        return $this->render('offers/index.html.twig', [
            'controller_name' => 'OffersController',
        ]);
    }
}
