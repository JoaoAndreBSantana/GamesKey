<?php
namespace App\Model\Repository;

use App\Model\Entity\Jogo;
use Doctrine\ORM\EntityRepository;
use App\Model\Entity\Usuario;
use App\Model\Entity\BibliotecaUsuario;

class JogoRepository extends EntityRepository{

    public function buscarTodos()
    {
        return $this->findAll();
    }



 public function buscarPorId(int $id): ?Jogo  
{
    return $this->find($id);
}

public function getEntityManager()
{
    return $this->_em;
}

   /* public function buscarPorNome($nome)
    {
        return $this->findOneBy(['nome' => $nome]);
    }*/

        
public function buscarJogosMaisVendidos($categoriaId)
{
    $conn = $this->getEntityManager()->getConnection();
    $pdo = $conn->getNativeConnection();

    $stmt = $pdo->prepare('CALL SPbuscar_jogos_maisVendidos(:categoriaId)');
    $stmt->bindParam(':categoriaId', $categoriaId, \PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function buscarJogosPorCategoriaPrecoAsc($categoriaId)
{
    $conn = $this->getEntityManager()->getConnection();
    $pdo = $conn->getNativeConnection();

    $stmt = $pdo->prepare('CALL SPbuscar_jogos_por_categoria_precoasc(:categoriaId)');
    $stmt->bindParam(':categoriaId', $categoriaId, \PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function buscarJogosPorCategoriaPrecoDesc($categoriaId)
{
    $conn = $this->getEntityManager()->getConnection();
    $pdo = $conn->getNativeConnection();

    $stmt = $pdo->prepare('CALL SPbuscar_jogos_por_categoria_preco_desc(:categoriaId)');
    $stmt->bindParam(':categoriaId', $categoriaId, \PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function buscarJogosMelhorAvaliacao($categoriaId)
{
    $conn = $this->getEntityManager()->getConnection();
    $pdo = $conn->getNativeConnection();

    $stmt = $pdo->prepare('CALL SPbuscar_melhor_avaliacao(:categoriaId)');
    $stmt->bindParam(':categoriaId', $categoriaId, \PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function buscarTodosJogos() {
    $conn = $this->getEntityManager()->getConnection();
    $stmt = $conn->executeQuery('CALL SP_todosJogos()');
    return $stmt->fetchAllAssociative(); // retorna array
}




public function adicionarJogoAoUsuario(int $usuarioId, int $jogoId): void {

    $usuario = $this->_em->getReference(Usuario::class, $usuarioId);
    $jogo = $this->_em->getReference(Jogo::class, $jogoId);

    
    $bibliotecaEntry = new BibliotecaUsuario();
    $bibliotecaEntry->setUsuario($usuario);
    $bibliotecaEntry->setJogo($jogo);

   
    $this->_em->persist($bibliotecaEntry);
    $this->_em->flush();
}


public function JogosUsuario(int $usuarioId): array
{
   return $this->createQueryBuilder('j')
        ->select('j.id', 'j.nome', 'j.preco', 'c.nome as categoria', 'bu.dataResgate')
        ->join('j.bibliotecaUsuarios', 'bu')
        ->join('j.categoria', 'c')  
        ->where('bu.usuario = :usuarioId')
        ->setParameter('usuarioId', $usuarioId)
        ->getQuery()
        ->getResult();
}

}
