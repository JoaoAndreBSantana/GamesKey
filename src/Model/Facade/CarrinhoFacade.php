<?php

// src/Model/Facade/CarrinhoFacade.php
namespace App\Model\Facade;

use App\Model\Repository\CarrinhoRepository;
use App\Model\Repository\ItemCarrinhoRepository;
use App\Model\Repository\JogoRepository;
use App\Model\Entity\Usuario;
use App\Model\Entity\Carrinho;
use App\Model\Entity\ItemCarrinho;
use App\Model\Entity\Jogo;
use Doctrine\ORM\EntityManagerInterface;
use App\Model\Repository\ComprovanteRepository;
use App\Model\Repository\ItemComprovanteRepository;
use Dom\Entity;

class CarrinhoFacade
{
    private $carrinhoRepository;
    private $itemCarrinhoRepository;
    private $jogoRepository;
    private $entityManager;
    private $comprovanteRepository;
    private $itemComprovanteRepository;
    private $usuarioRepository;


    public function __construct(
        CarrinhoRepository $carrinhoRepository,
        ItemCarrinhoRepository $itemCarrinhoRepository,
        JogoRepository $jogoRepository,
        EntityManagerInterface $entityManager,
        ComprovanteRepository $comprovanteRepository,
        ItemComprovanteRepository $itemComprovanteRepository
    ) {
        $this->carrinhoRepository = $carrinhoRepository;
        $this->itemCarrinhoRepository = $itemCarrinhoRepository;
        $this->jogoRepository = $jogoRepository;
        $this->entityManager = $entityManager;
        $this->comprovanteRepository = $comprovanteRepository;
        $this->itemComprovanteRepository = $itemComprovanteRepository;
    }


    
    public function adicionarJogo(Usuario $usuario, int $jogoId, float $preco): void
    {
        $usuario = $this->entityManager->getReference(Usuario::class, $usuario->getId());

        
        $carrinho = $this->carrinhoRepository->buscarCarrinhoAtivo($usuario) 
            ?? $this->carrinhoRepository->criarCarrinho($usuario);

        $jogo = $this->jogoRepository
            ->getEntityManager()
            ->getReference(Jogo::class, $jogoId);

       
        $this->itemCarrinhoRepository->adicionarItem($carrinho, $jogo, $preco);
    }



public function removerItem(int $itemId, Carrinho $carrinho): void
{
    
    $item = $this->itemCarrinhoRepository->find($itemId);
    
    if ($item) {
  
        $carrinho->getItens()->removeElement($item);
        
       
       // $this->itemCarrinhoRepository->removerItem($itemId);
        $this->entityManager->remove($item);
        
        $this->entityManager->flush();
    }
}

public function acharItensCarrinho(int $usuarioId): array
{
    return $this->itemCarrinhoRepository->acharItensCarrinho($usuarioId);
}






public function finalizarCompra(int $usuarioId): string
{
    $usuario = $this->entityManager->getReference(Usuario::class, $usuarioId);
    $carrinho = $this->carrinhoRepository->buscarCarrinhoAtivo($usuario);

    if (!$carrinho || $carrinho->getItens()->isEmpty()) {
        return '';
    }

  
    $total = 0;
    foreach ($carrinho->getItens() as $item) {
        $total += $item->getPrecoUnitario();
    }

    
    $chave = substr(bin2hex(random_bytes(5)), 0, 10);

    $comprovante = $this->comprovanteRepository->criarComprovante($usuario, $total, $chave);

    
    foreach ($carrinho->getItens() as $item) {
        $this->itemComprovanteRepository->adicionarItemAoComprovante(
            $comprovante,
            $item->getJogo(),
            $item->getPrecoUnitario()
        );
    }

      $this->entityManager->flush(); 


    return $chave;
}








public function resgatarJogos(int $usuarioId, string $chave): bool
{
    
    $comprovante = $this->comprovanteRepository->buscarChave($chave);
    if (!$comprovante || $comprovante->getUsuario()->getId() !== $usuarioId) {
        return false;
    }

    
    if ($comprovante->isResgatado()) {
        return false;
    }

   
    foreach ($comprovante->getItens() as $item) {
        $this->jogoRepository->adicionarJogoAoUsuario(
            $usuarioId,
            $item->getJogo()->getJogoId()
        );
    }

  
    $this->comprovanteRepository->marcarResgatado($comprovante);
    
    $carrinho = $this->carrinhoRepository->buscarCarrinhoAtivo(
        $this->entityManager->getReference(Usuario::class, $usuarioId)
    );
    if ($carrinho) {
        $this->carrinhoRepository->limparCarrinho($carrinho);
    }

    return true;
}




}
