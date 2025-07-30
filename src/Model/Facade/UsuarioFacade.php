<?php
namespace App\Model\Facade;

use App\Model\Repository\UsuarioRepository;

class UsuarioFacade
{
    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function autenticarUsuario(string $email, string $senha): ?object//irei chamar o método autenticarUsuario no controlador
    {
        
        $usuario = $this->usuarioRepository->buscarPoremail($email);

        if (!$usuario) {
            return null; // usuário não encontrado
        }

        //verifica se a senha  bate com a senha hash armazenada
        if (password_verify($senha, $usuario->getSenha())) {
            return $usuario; // autenticado com sucesso
        }

        return null; // senha inválida
    }
}
