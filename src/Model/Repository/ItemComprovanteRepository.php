<?php
namespace App\Model\Repository;

use App\model\entity\ItemComprovante;
use Doctrine\ORM\EntityRepository;
use App\model\entity\Comprovante;
use App\model\entity\Jogo;
use App\model\entity\Carrinho;

class ItemComprovanteRepository extends EntityRepository
{
    public function buscarTodos(): array
    {
        return $this->findAll();
    }

    public function buscarPorId(int $id): ?ItemComprovante
    {
        return $this->find($id);
    }

    public function removerItemComprovante(ItemComprovante $itemComprovante): void
    {
        $this->_em->remove($itemComprovante);
        $this->_em->flush();
    }




    public function salvarItemComprovante(ItemComprovante $itemComprovante): void
    {
        $this->_em->persist($itemComprovante);
        $this->_em->flush();
    }

    public function adicionarItemAoComprovante(Comprovante $comprovante, Jogo $jogo, float $preco): void
 {
    $item = new ItemComprovante();
    $item->setComprovante($comprovante);
    $item->setJogo($jogo);
    $item->setPrecoPago($preco);
    
    $this->_em->persist($item);
}

}
