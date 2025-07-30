<?php

namespace App\Controller;
require_once __DIR__ . '/../config/bootstrap.php';// Carregando o bootstrap para inicializar o EntityManager

use App\Model\Entity\Categoria;
use App\Model\Repository\CategoriaRepository;
use App\Model\Facade\CategoriaFacade;

class CategoriaController{
    // atributo para armazenar a instância da CategoriaFacade
    //permite usar os metodos da categoriafacade
    private $categoriaFacade;

    public function __construct(CategoriaFacade $categoriaFacade)
    {
        $this->categoriaFacade = $categoriaFacade;
    }



    public function carregarCategorias()
{

    $categorias = $this->categoriaFacade->listarCategorias();

   extract(['categorias' => $categorias]);  
   
include __DIR__ . '/../View/pesquisar_jogos.php';
}

}

