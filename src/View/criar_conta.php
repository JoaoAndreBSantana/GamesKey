<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Criar Nova Conta</h1>
        
        <form action="index.php?rota=criarConta" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            

            
            <div style="text-align: center;">
                <button type="submit" class="btn btn-success">Criar Conta</button>
            </div>
        </form>
        
        <div class="back-button">
           <a href="index.php?rota=login" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</body>
</html>

