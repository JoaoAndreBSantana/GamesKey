<?php

namespace App\Controller;
require_once __DIR__ . '/../config/bootstrap.php';// Carregando o bootstrap para inicializar o EntityManager

use App\Model\Entity\Usuario;
use App\Model\Repository\UsuarioRepository;
use App\Model\Facade\UsuarioFacade;

class UsuarioController 
{
    public function FormCriarConta()//renderizando a view de criar conta
    {
        include __DIR__ . '/../View/criar_conta.php';//caminho para a view
    }

    public function criarConta()//processando o formulário de criação de conta
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {//verifica se o método é POST
            $nome = $_POST['nome'];//obtendo o nome do usuário
            $email = $_POST['email'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);//criptografando a senha

            $usuario = new Usuario();//instanciando o objeto usuario
            $usuario->setNome($nome);//definindo o nome do usuário
            $usuario->setEmail($email);
            $usuario->setSenha($senha);

            global $entityManager;//acessando o EntityManager global
            $entityManager->persist($usuario);//persistindo o usuário
            $entityManager->flush();//salvando as alterações no banco de dados


            header('Location: index.php?rota=login');
            exit;
        }
    }



    public function FormLogarConta()//renderizando a view de login
    {
        include __DIR__ . '/../View/logar_conta.php';//caminho para a view
    }


   public function logarConta()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {// Verifica se o método e post
        $email = $_POST['email'] ?? '';//  o email do formulario
        $senha = $_POST['senha'] ?? '';// senha

        global $entityManager;

        $usuarioRepository = $entityManager->getRepository(\App\Model\Entity\Usuario::class);
        $usuarioFacade = new UsuarioFacade($usuarioRepository);

        $usuario = $usuarioFacade->autenticarUsuario($email, $senha);// 
//se o usuário for encontrado e a senha for valida... retornará o objeto usuario, caso contrario, retorna null

        if ($usuario) {// Se tudo estiver ok
           // Armazena o email, nome e id na session
            $_SESSION['usuario_email'] = $usuario->getEmail();
            $_SESSION['usuario_id'] = $usuario->getId();
            $_SESSION['usuario_nome'] = $usuario->getNome();

            header('Location: index.php?rota=telaUsuario');// redireciona para a tela do usuário
            exit;
        } else {
            header('Location: index.php?rota=FormLogarConta&erro=1');
            exit;
        }
    }
}




public function telaUsuario()
{
    

    include __DIR__ . '/../View/tela_usuario.php';

}


}
