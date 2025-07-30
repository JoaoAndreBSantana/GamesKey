<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Compras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="layout-novo">
    <div class="container">
        <h1>Minhas Compras</h1>
        
        <div id="secaoComprovantes">
            <h2>Comprovantes de Compra</h2>
            
            <?php foreach ($comprovantes as $comp): ?>
            <div class="receipt">
                <div>
                    <h3>GamesKey</h3>
                    <p><strong>Comprovante de Compra #<?= $comp->getId() ?></strong></p>
                    <p>Data: <?= $comp->getDataCompra()->format('d/m/Y - H:i') ?></p>
                </div>
              
                <div class="receipt-summary">
                    <div class="receipt-total-line total-final">
                        <span>Subtotal:</span>
                        <span>R$ <?= number_format($comp->getValorTotal(), 2, ',', '.') ?></span>
                    </div>
                    <div class="receipt-total-line total-final">
                        <span>Chave gerada:</span>
                        <span><?= $comp->getChaveGerada() ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="back-button">
            <a href="index.php?rota=telaUsuario" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</body>
</html>