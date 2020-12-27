<?php

namespace App\Controller;

use App\Repository\BatchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffersController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(BatchRepository $batchRepository): Response
    {
        return $this->render('offers/index.html.twig', [
            'controller_name' => 'OffersController',
        ]);
    }
}
