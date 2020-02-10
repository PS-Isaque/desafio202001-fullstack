<?php

namespace App\Service;

use App\Entity\Endereco;
use App\Form\EnderecoType;
use App\Repository\EnderecoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class EnderecoService extends AbstractController
{
    /**
     * @var EnderecoRepository
     */
    private $enderecoRepository;

    public function __construct(EnderecoRepository $enderecoRepository)
    {
        $this->enderecoRepository = $enderecoRepository;
    }

    /**
     * @return ArrayCollection
     */
    public function findAll(): ArrayCollection
    {
        return new ArrayCollection($this->enderecoRepository->findAll());
    }

    public function create(Request $enderecoRequest)
    {
        $data = json_decode($enderecoRequest->getContent(), true);
        $endereco = new Endereco();
        $form = $this->createForm(EnderecoType::class, $endereco);
        $form->submit($data);
        $em = $this->getDoctrine()->getManager();
        $em->persist($endereco);
        $em->flush();
    }

    public function delete($id)
    {
        $endereco = $this->enderecoRepository->find($id);

        if (!$endereco) {
            throw new \Exception("Endereço não existe para ser deletada!");
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($endereco);
        $em->flush();
    }


    public function update(Request $request, $id)
    {
        $endereco = $this->enderecoRepository->find($id);
        $data = json_decode($request->getContent(), true);

        if (!$endereco) {
            throw new \Exception("Endereco não existe para ser atualizada!");
        }

        $form = $this->createForm(EnderecoType::class, $endereco);
        $form->submit($data);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
    }

    public function show($id)
    {
        $endereco = $this->enderecoRepository->find($id);

        if (!$endereco) {
            throw new \Exception("Empresa não existe!");
        }

        return $endereco;
    }
}