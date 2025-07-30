

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resgatar Chave - Loja de Jogos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="layout-novo">
    <div class="container">
         

    
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert alert-success" style="margin: 20px 0; padding: 15px; border-radius: 5px; background-color: #d4edda; color: #155724;">
                <?= $_SESSION['mensagem'] ?>
            </div>
            <?php unset($_SESSION['mensagem']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-danger" style="margin: 20px 0; padding: 15px; border-radius: 5px; background-color: #f8d7da; color: #721c24;">
                <?= $_SESSION['erro'] ?>
            </div>
            <?php unset($_SESSION['erro']); ?>
        <?php endif; ?>
        


        <h1>Resgatar Jogos</h1>
        
        <div style="text-align: center; margin-bottom: 30px; color: #666;">
            <p>Digite a chave correspondente da sua compra</p>
        </div>
        
        <form action="index.php?rota=ResgatarChave" method="POST">
            <div class="form-group">
                <label for="chave">Chave da Compra:</label>
                <input type="text" id="chave" name="chave" required 
                       placeholder="Ex: 6geq59gte" 
                      style="font-family: monospace;">
            </div>
            
            <div style="text-align: center;">
                <button type="submit" class="btn btn-success">Resgatar Chave</button>
            </div>
        </form>
        
        
        <div class="back-button">
          <a href="index.php?rota=telaUsuario" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</body>
</html>

