<?php
namespace App\Model\Repository;

use App\Model\Entity\Usuario;
use Doctrine\ORM\EntityRepository;//usando o entityrepository do doctrine para manipulação de entidades 

class UsuarioRepository extends EntityRepository{

    public function salvar(Usuario $usuario)//
    {
        $em = $this->getEntityManager();//obtendo o EntityManager
        $em->persist($usuario);//persistindo o usuario no banco
        $em->flush();//salvando alteracoes no banco de dados
    }

    public function buscarPorId($id)
    {
        return $this->find($id);// Retorna o usuario pelo id
    }
    public function buscarPoremail($email)
    {
        return $this->findOneBy(['email' => $email]);//aqui procura o usuário pelo email
    
    }

    public function atualizar(Usuario $usuario)// Atualiza o usuário no banco de dados
{
     /**@var EntityManager $em */
    $em = $this->getEntityManager();// Obtendo o EntityManager 
    // verifica se o usuário já está gerenciado pelo EntityManager
    //se n estiver, o merge é n ecessário para garantir que o usuário seja atualizado corretamente
    if (!$em->contains($usuario)) {
        $usuario = $em->merge($usuario);// Mescla o usuário com o EntityManager
    }

    $em->flush();// Salva as alterações no banco de dados
}

    public function remover(Usuario $usuario)
    {
        $em = $this->getEntityManager();
        $em->remove($usuario);// Remove o usuário
        $em->flush();// Salva as alterações no banco de dados
    }


}