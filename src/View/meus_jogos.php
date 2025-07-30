<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Jogos - Loja de Jogos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="layout-novo">
    <div class="container">
        <h1>Meus Jogos</h1>
        
        <div style="text-align: center; margin-bottom: 20px;">
            <p>Jogos adquiridos</p>
        </div>
        
        <div class="game-list">
            <?php if (!empty($jogos)): ?>
                <?php foreach ($jogos as $jogo): ?>
                    <div class="game-item">
                        <div class="game-info">
                            <div class="game-name"><?= htmlspecialchars($jogo['nome']) ?></div>
                            <div class="game-category"><?= htmlspecialchars($jogo['categoria'] ?? 'Sem categoria') ?></div>
                            <div style="margin-top: 5px;">
                                <small>Data de compra: <?= $jogo['dataResgate']->format('d/m/Y') ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="game-item">
                    <div class="game-info">
                        <div class="game-name">Nenhum jogo adquirido ainda</div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="back-button">
            <a href="index.php?rota=telaUsuario" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</body>
</html>