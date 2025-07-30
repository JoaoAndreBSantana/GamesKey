<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho </title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="layout-novo">
    <div class="container">
        <h1>Meu Carrinho</h1>
        

       
<?php 
$subtotal = 0;
foreach ($itensCarrinho as $item): 
    $subtotal += $item['preco'];
?>
<div class="total-section">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="game-name"><?= htmlspecialchars($item['jogo']) ?></div>
          
        </div>
        <div style="display: flex; align-items: center; gap: 15px;">
            
            <span class="game-price">R$ <?= number_format($item['preco'], 2, ',', '.') ?></span>

            <form action="index.php?rota=DeletaItemCarrinho" method="POST" style="display: inline;">
                <input type="hidden" name="item_id" value="<?= $item['item_id'] ?>">
                <button type="submit" class="btn btn-danger">Remover</button>
            </form>

        </div>
    </div>
</div>
<?php endforeach; ?>





<div class="total-section">
   
    <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: bold;">
        <span>Total:</span>
        <span class="total-price">R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
    </div>
</div>
        



      <div class="total-section">
    <h1>Finalizar Compra</h1>
    <h2>Selecione a forma de pagamento:</h2>
    
 
    <form action="index.php?rota=FinalizarCompra" method="POST">
        <div class="form-group">
            <div style="margin-top: 10px;">



                <label style="display: flex; align-items: center; margin-bottom: 10px;">
                    <input type="radio" name="pagamento" value="pix" required style="margin-right: 10px;">
                    <span>PIX</span>
                </label>

                <label style="display: flex; align-items: center;">
                    <input type="radio" name="pagamento" value="cartao" required style="margin-right: 10px;">
                    <span>Cartão de Crédito</span>
                </label>


            </div>
        </div>
        
        <button type="submit" class="btn btn-success" style="font-size: 18px; padding: 15px 30px;">
            Confirmar Compra
        </button>

    </form>
</div>
        
        <div class="back-button">
            <a href="index.php?rota=telaUsuario" class="btn btn-secondary">Voltar</a>
        </div>

    </div>
</body>
</html>

