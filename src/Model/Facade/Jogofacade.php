<?php
namespace App\Model\Facade;

use App\Model\Repository\JogoRepository;

class JogoFacade
{
     private $jogoRepository;

    public function __construct(JogoRepository $jogoRepository)
    {
        $this->jogoRepository = $jogoRepository;
    }

   
    public function buscarMaisVendidos($categoriaId)
    {
        return $this->jogoRepository->buscarJogosMaisVendidos($categoriaId);
    }

    public function buscarPorCategoriaPrecoAsc($categoriaId)
    {
        return $this->jogoRepository->buscarJogosPorCategoriaPrecoAsc($categoriaId);
    }

    public function buscarPorCategoriaPrecoDesc($categoriaId)
    {
        return $this->jogoRepository->buscarJogosPorCategoriaPrecoDesc($categoriaId);
    }

    public function buscarMelhorAvaliacao($categoriaId)
    {
        return $this->jogoRepository->buscarJogosMelhorAvaliacao($categoriaId);
    }

    public function buscarTodosJogos()
    {
        return $this->jogoRepository->buscarTodosJogos();
    }



    

    public function JogosUsuario(int $usuarioId): array 
    {
    return $this->jogoRepository->JogosUsuario($usuarioId);
    }

}