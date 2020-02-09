<?php

namespace App\Controller;

use App\Service\EnderecoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnderecoController extends AbstractController
{
    /**
     * @var EnderecoService
     */
    private $enredecoService;

    public function  __construct(EnderecoService $enredecoService)
    {
        $this->enredecoService = $enredecoService;
    }

    /**
     * @Route("/enderecos", name="endereco")
     * @return JsonResponse
     */
    public function index()
    {
        $enderecos = $this->enredecoService->findAll();

        return $this->json($enderecos, Response::HTTP_OK);
    }


    public function create()
    {

    }
}
