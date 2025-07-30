<?php
namespace App\Model\Repository;

use App\Model\Entity\ItemCarrinho;
use App\Model\Entity\Carrinho;
use App\Model\Entity\Jogo;
use Doctrine\ORM\EntityRepository;

class ItemCarrinhoRepository extends EntityRepository
{
    
  public function adicionarItem(Carrinho $carrinho, Jogo $jogo, float $preco): void
{
    $item = new ItemCarrinho();
    $item->setCarrinho($carrinho)
         ->setJogo($jogo) // Usa o método setJogo para associar o jogo ao item, ele é o objeto Jogo
         ->setPrecoUnitario($preco);
    
    $this->_em->persist($item);
    $this->_em->flush();
}

    public function removerItem(int $itemId): void
    {
        $item = $this->_em->find(ItemCarrinho::class, $itemId);
        if ($item) {
            $this->_em->remove($item);
            $this->_em->flush();
        }
    }

    public function acharItensCarrinho(int $usuarioId): array
{
    return $this->createQueryBuilder('ic')
        ->join('ic.carrinho', 'c')
        ->join('ic.jogo', 'j')
        ->select('ic.id as item_id', 'j.nome as jogo', 'ic.precoUnitario as preco')
        ->where('c.usuario = :usuarioId')
        ->andWhere('c.finalizado = false')
        ->setParameter('usuarioId', $usuarioId)
        ->getQuery()
        ->getArrayResult();
}
    
}