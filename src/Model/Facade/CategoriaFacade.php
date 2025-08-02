<?php

// src/Model/Facade/CategoriaFacade.php
namespace App\Model\Facade;

use App\Model\Repository\CategoriaRepository;

class CategoriaFacade
{
    private $categoriaRepository;
    

    public function __construct(CategoriaRepository $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function listarCategorias()
    {
        return $this->categoriaRepository->buscarTodas();
    }
}
