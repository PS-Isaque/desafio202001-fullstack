<?php

namespace App\Controller;

use App\Service\EnderecoService;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/enderecos", name="endereco", methods={"GET"})
     * @return JsonResponse
     */
    public function index()
    {
        $enderecos = $this->enredecoService->findAll();

        return $this->json($enderecos, Response::HTTP_OK);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/endereco", name="endereco_create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $this->enredecoService->create($request);

        return $this->json(['status' => 'ok'], Response::HTTP_OK);
    }

    /**
     * @Route("/endereco/{id}", name="endereco_delete", methods={"DELETE"})
     */
    public function delete($id)
    {
        try {
            $this->enredecoService->delete($id);

            return $this->json(['status' => 'Removido'], Response::HTTP_OK);
        } catch (\Exception $exception) {

            return $this->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @Route("/endereco/{id}", name="endereco_update", methods={"PUT"})
     */
    public function update(Request $request,$id)
    {
        try {
            $this->enredecoService->update($request, $id);

            return $this->json(['status' => 'Atualizado'], Response::HTTP_OK);
        } catch (\Exception $exception) {

            return $this->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     * @Route("/endereco/{id}", name="endereco_show", methods={"GET"})
     */
    public function show($id)
    {
        try {
            $endereco = $this->enredecoService->show($id);

            return $this->json($endereco, Response::HTTP_OK);
        } catch (\Exception $exception) {

            return $this->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
