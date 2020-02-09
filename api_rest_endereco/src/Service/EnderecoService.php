<?php

namespace App\Service;

use App\Repository\EnderecoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use PhpParser\Node\Expr\Array_;

class EnderecoService
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

    public function create()
    {

    }
}