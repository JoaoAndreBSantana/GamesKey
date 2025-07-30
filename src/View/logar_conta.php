<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Login - Loja de Jogos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Fazer Login</h1>
        
        <form action="index.php?rota=logarConta" method="POST">

            
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            
            <div style="text-align: center;">
                <button type="submit" class="btn">Entrar</button>
            </div>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <p>Não tem uma conta? <a href="index.php?rota=FormCriarConta" style="color: #3498db;">Criar conta</a></p>
        </div>
        
        <div class="back-button">
         <a href="index.php?rota=login" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</body>
</html>

