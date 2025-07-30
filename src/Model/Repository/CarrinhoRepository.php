<?php
// src/model/repository/CarrinhoRepository.php

namespace App\Model\Repository;

use App\model\entity\{
    Carrinho,
    ItemCarrinho,
    Usuario,
    Jogo
};
use Doctrine\ORM\EntityRepository;

class CarrinhoRepository extends EntityRepository
{


     public function buscarCarrinhoAtivo(Usuario $usuario): ?Carrinho
    {
        return $this->_em->getRepository(Carrinho::class)->findOneBy([
            'usuario' => $usuario,
            'finalizado' => false
        ]);
    }

    public function criarCarrinho(Usuario $usuario): Carrinho
    {
        $carrinho = new Carrinho();
        $carrinho->setUsuario($usuario);
        $this->_em->persist($carrinho);
        $this->_em->flush();
        return $carrinho;
    }

    public function buscarIdCarrinho(int $id): ?Carrinho
    {
        return $this->_em->getRepository(Carrinho::class)->find($id);
    }


    
   public function limparCarrinho(Carrinho $carrinho): void
{
    $this->_em->remove($carrinho);
    $this->_em->flush();
}

    


}