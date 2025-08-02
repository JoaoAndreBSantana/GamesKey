<?php
namespace App\Controller;
require_once __DIR__ . '/../config/bootstrap.php';

use App\Model\Facade\CarrinhoFacade;
use App\Model\Repository\CarrinhoRepository;
use App\Model\Entity\Usuario;
use App\Model\Entity\Carrinho;
use App\Model\Entity\ItemCarrinho;
use App\Model\Repository\ItemCarrinhoRepository;
use App\Model\Repository\JogoRepository;
use App\Model\Repository\UsuarioRepository;
use App\Model\Repository\ComprovanteRepository;
use App\Model\Repository\ChaveRepository;


class CarrinhoController
{
    private $carrinhoFacade;
    private $carrinhoRepository;


    public function __construct()
    {
        global $entityManager;
        
       
        $carrinhoRepository = new CarrinhoRepository(
            $entityManager,
            $entityManager->getClassMetadata('App\Model\Entity\Carrinho')
        );
        
        $itemCarrinhoRepository = new \App\Model\Repository\ItemCarrinhoRepository(
            $entityManager,
            $entityManager->getClassMetadata('App\Model\Entity\ItemCarrinho')
        );
        
        $jogoRepository = new \App\Model\Repository\JogoRepository(
            $entityManager,
            $entityManager->getClassMetadata('App\Model\Entity\Jogo')
        );
        $comprovanteRepository = new \App\Model\Repository\ComprovanteRepository(
            $entityManager,
            $entityManager->getClassMetadata('App\Model\Entity\Comprovante')
        );
        $itemComprovanteRepository = new \App\Model\Repository\ItemComprovanteRepository(
            $entityManager,
            $entityManager->getClassMetadata('App\Model\Entity\ItemComprovante')
        );
        
        $this->carrinhoFacade = new CarrinhoFacade(
            $carrinhoRepository,
            $itemCarrinhoRepository,
            $jogoRepository,
            $entityManager,
            $comprovanteRepository,
            $itemComprovanteRepository
        );
    }


    

    public function MeuCarrinho()
{
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php?rota=FormLogarConta');
        exit;
    }

    $itensCarrinho = $this->carrinhoFacade->acharItensCarrinho($_SESSION['usuario_id']) ?? [];
    
    include __DIR__ . '/../View/meu_carrinho.php';
}




    public function adicionaCarrinho()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?rota=FormLogarConta');
            exit;
        }

        $jogoId = (int) ($_POST['id_jogo'] ?? 0);
        $preco = (float) ($_POST['preco_jogo'] ?? 0.0);

      
        $usuario = new Usuario();
        $usuario->setId($_SESSION['usuario_id']);

        $this->carrinhoFacade->adicionarJogo($usuario, $jogoId, $preco);

        header('Location: index.php?rota=pesquisarJogos');
        exit;
    }



    public function DeletaItemCarrinho()
{
    global $entityManager; 

   
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php?rota=FormLogarConta');
        exit;
    }

    
    $itemId = (int) ($_POST['item_id'] ?? 0);

   
    $item = $entityManager->find(ItemCarrinho::class, $itemId);

    if ($item) {
        
        $this->carrinhoFacade->removerItem($itemId, $item->getCarrinho());
    }

    header('Location: index.php?rota=MeuCarrinho');
    exit;
}





public function FinalizarCompra()
{
    global $entityManager;

    
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php?rota=FormLogarConta');
        exit;
    }

        $this->carrinhoFacade->finalizarCompra($_SESSION['usuario_id']);


    header('Location: index.php?rota=MeuCarrinho');
    exit;
}



public function ResgatarChave()
{
    
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php?rota=FormLogarConta');
        exit;
    }
    
     if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?rota=FormResgatarChave');
        exit;
    }

    $chave = $_POST['chave'] ?? '';


    $resultado = $this->carrinhoFacade->resgatarJogos($_SESSION['usuario_id'], $chave);

    if ($resultado) {
        $_SESSION['mensagem'] = 'Jogos resgatados com sucesso!';
    } else {
        $_SESSION['erro'] = 'Chave inválida, já utilizada ou não pertence a você.';
    }



    header('Location: index.php?rota=FormResgatarChave');
    exit;
}


public function VisuChave()
{
    
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php?rota=FormLogarConta');
        exit;
    }


    global $entityManager;
    $comprovantes = $entityManager->getRepository('App\Model\Entity\Comprovante')
        ->findBy(['usuario' => $_SESSION['usuario_id']]);
   

    include __DIR__ . '/../View/visu_chave.php';

}





public function FormResgatarChave()
{
    

    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php?rota=FormLogarConta');
        exit;
    }


      global $entityManager;
    $comprovantes = $entityManager->getRepository('App\Model\Entity\Comprovante')->findBy([
        'usuario' => $entityManager->getReference(Usuario::class, $_SESSION['usuario_id'])
    ]);


    include __DIR__ . '/../View/resgatar_chave.php';

}



}
