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

    public function autenticarUsuario(string $email, string $senha): ?object
    {
        
        $usuario = $this->usuarioRepository->buscarPoremail($email);

        if (!$usuario) {
            return null; 
        }

       
        if (password_verify($senha, $usuario->getSenha())) {
            return $usuario;
        }

        return null; 
    }
}
