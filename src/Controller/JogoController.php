<?php

namespace App\Controller;
require_once __DIR__ . '/../config/bootstrap.php';// Carregando o bootstrap para inicializar o EntityManager

use App\Model\Entity\Jogo;
use App\Model\Repository\JogoRepository;
use App\Model\Facade\JogoFacade;
use App\Model\Facade\CategoriaFacade;

class JogoController
{

    /*private $categoriaFacade;

    
    public function __construct(CategoriaFacade $categoriaFacade)
    {
        $this->categoriaFacade = $categoriaFacade;
    }*/
    
   
   public function pesquisarJogos()
{
    
    global $entityManager;
    
    // prepara os repositorios e facades
    $categoriaRepository = new \App\Model\Repository\CategoriaRepository(
        $entityManager,
        $entityManager->getClassMetadata(\App\Model\Entity\Categoria::class)
    );
    
    $jogoRepository = new \App\Model\Repository\JogoRepository(
        $entityManager,
        $entityManager->getClassMetadata(\App\Model\Entity\Jogo::class)
    );
    
    $categoriaFacade = new \App\Model\Facade\CategoriaFacade($categoriaRepository);
    $jogoFacade = new \App\Model\Facade\JogoFacade($jogoRepository);

    //  busca categorias
    $categorias = $categoriaFacade->listarCategorias();
    
    //processa filtros
    $categoriaId = $_GET['categoria_id'] ?? null;
    $ordenacao = $_GET['ordenar'] ?? 'preco_asc';//valor padrao para ordenação
    
    
    if ($categoriaId) {
        switch ($ordenacao) {
            case 'preco_asc':
                $jogos = $jogoFacade->buscarPorCategoriaPrecoAsc($categoriaId);
                break;
            case 'preco_desc':
                $jogos = $jogoFacade->buscarPorCategoriaPrecoDesc($categoriaId);
                break;
            case 'avaliacao'://acabou que irei usar futuramente, numa futura atualização
                $jogos = $jogoFacade->buscarMelhorAvaliacao($categoriaId); 
                break;
            case 'mais_vendidos':
                $jogos = $jogoFacade->buscarMaisVendidos($categoriaId);
                break;
            default:
                $jogos = $jogoFacade->buscarPorCategoriaPrecoAsc($categoriaId);
        }
    } else {
        $jogos = $jogoFacade->buscarTodosJogos(); // busca todos os jogos se nenhum filtro for aplicado
    }

    
    $dadosView = [
        'categorias' => $categorias,
        'jogos' => $jogos,
        'categoriaSelecionada' => $categoriaId,
        'ordenacaoSelecionada' => $ordenacao
    ];
    
    include __DIR__ . '/../View/pesquisar_jogos.php';
}







public function MeuJogos()
{
    global $entityManager;
    
    // 1. Verifica autenticação (importante!)
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php?rota=FormLogarConta');
        exit;
    }

    // 2. Prepara o repositório e facade
    $jogoRepository = new JogoRepository(
        $entityManager,
        $entityManager->getClassMetadata(Jogo::class)
    );
    $jogoFacade = new JogoFacade($jogoRepository);

    // 3. Obtém os jogos do usuário
    $jogos = $jogoFacade->JogosUsuario($_SESSION['usuario_id']);

    // 4. Passa para a view
    include __DIR__ . '/../View/meus_jogos.php';
}

    






}