<?php
namespace App\Model\Repository;

use App\model\entity\Comprovante;
use Doctrine\ORM\EntityRepository;
use App\model\entity\Usuario;

class ComprovanteRepository extends EntityRepository
{
    public function buscarTodos(): array
    {
        return $this->findAll();
    }

    public function buscarPorId(int $id): ?Comprovante
    {
        return $this->find($id);
    }



    public function criarComprovante(Usuario $usuario, float $total, string $chave): Comprovante
    {
    $comprovante = new Comprovante();
    $comprovante->setUsuario($usuario);
    $comprovante->setValorTotal($total);
    $comprovante->setChaveGerada($chave);
    
    $this->_em->persist($comprovante);
    $this->_em->flush();// Garante que o comprovante foi salvo no banco de dados
    return $comprovante;
    }

    public function buscarChave(string $chave): ?Comprovante
    {
        return $this->findOneBy(['chaveGerada' => $chave]);
    }

    public function marcarResgatado(Comprovante $comprovante): void
    {
        $comprovante->setResgatado(true);
        $this->_em->flush();
    }


    public function buscarChaveComItens(string $chave): ?Comprovante
{
    return $this->createQueryBuilder('c')
        ->leftJoin('c.itens', 'i')       // carrega os itens do comprovante
        ->leftJoin('i.jogo', 'j')        // do jogo de cada item
        ->addSelect('i')                 //garanto quee os itens sejam retornados
        ->addSelect('j')                 // garante retorno dos jogos
        ->where('c.chaveGerada = :chave')
        ->setParameter('chave', $chave)
        ->getQuery()
        ->getOneOrNullResult();//retorna o comprovante com os itens e jogos carregados
}


}
