<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(CallApiService $callApiService): Response
    {
        //dd($callApiService->getAllData());

        return $this->render('home/index.html.twig', [
            'data' => $callApiService->getFranceData(),
            'departements' => $callApiService->getAllData()
        ]);

    }
}
