<?php
session_start(); //inicia a sessao para acessar os dados do usuário autenticado


require_once '../vendor/autoload.php';// Autoload do Composer para carregar as classes 
require_once '../src/Controller/UsuarioController.php';

$rota = $_GET['rota'] ?? 'login';//rota padrao
//instanciando os controller
$controller = new \App\Controller\UsuarioController();
$jogoController = new \App\Controller\JogoController();
$carrinhoController = new \App\Controller\CarrinhoController();

switch ($rota) {//verificando a rota solicitada
    case 'FormCriarConta':
       
        $controller->FormCriarConta();// incluindo a view de criar conta
        break;

    case 'criarConta':
        $controller->criarConta();
        break;

    case 'FormLogarConta':
        $controller->FormLogarConta();
        break;

    case 'logarConta':
        $controller->logarConta();
        break;

    case 'telaUsuario':
        
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?rota=FormLogarConta');
            exit;
        }
        $controller->telaUsuario();//
        break;

        
    case 'pesquisarJogos':
        $jogoController->pesquisarJogos(); 
        break;

        
    case 'MeuCarrinho':
    $carrinhoController->MeuCarrinho();
    break;
    
    case 'adicionaCarrinho':
    $carrinhoController->adicionaCarrinho();
    break;
    
    case 'DeletaItemCarrinho':
    $carrinhoController->DeletaItemCarrinho();
    break;

    case 'FinalizarCompra':
    $carrinhoController->FinalizarCompra();
    break;


    case 'ResgatarChave':
    $carrinhoController->ResgatarChave();
    break;

    case 'FormResgatarChave':
    $carrinhoController->FormResgatarChave();
    break;

    case 'VisuChave':
    $carrinhoController->VisuChave();
        break;

    case 'MeuJogos':
        $jogoController->MeuJogos(); 
    break;
        

    case 'login':
    default:
        include 'login.php';
}
