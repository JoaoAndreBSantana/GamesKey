<?php

if (!isset($_SESSION['usuario_nome'])) {// Verifica se o usuário está autenticado
    header('Location: index.php?rota=FormLogarConta');// Redireciona para a página de login se não estiver autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu principal do usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Menu Principal</h1>
        
        <div style="text-align: center; margin-bottom: 30px; color: #e0e0e0;">
            <p>Bem-vindo, <strong><?php echo $_SESSION['usuario_nome'] ?? ''; ?></strong>!</p>
            <p>Email: <strong><?php echo $_SESSION['usuario_email'] ?? ''; ?></strong></p>
        </div>
        
        <div class="menu-buttons" style="background-color: #2a2a2a; padding: 20px; border-radius: 10px;">
            <a href="index.php?rota=pesquisarJogos" class="btn btn-primary">
                Pesquisar Jogos
            </a>
            
            <a href="index.php?rota=MeuJogos" class="btn btn-primary">
                Meus Jogos
            </a>
            
            <a href="index.php?rota=FormResgatarChave" class="btn btn-primary">
                Resgatar Chave
            </a>
            
            <a href="index.php?rota=MeuCarrinho" class="btn btn-primary">
                Meu Carrinho
            </a>
            
            <a href="index.php?rota=VisuChave" class="btn btn-primary">
                Chaves e Compras
            </a>
            
        </div>
        
        <div class="back-button">
            <a href="index.php?rota=login" class="btn btn-secondary">Sair</a>
        </div>
    </div>
</body>
</html>

