<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pesquisar jogos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="layout-novo">
    <div class="container">
        <h1>Pesquisar Jogos</h1>
        
        <div class="filter-section">
            <h2>Filtros de Busca</h2>
          <form action="index.php" method="GET">
            <input type="hidden" name="rota" value="pesquisarJogos">
                <div class="filter-row">

                    
                    <div class="filter-group">
                        <label for="categoria">Categoria:</label>
 <select id="categoria" name="categoria_id">
                      <?php foreach ($dadosView['categorias'] as $categoria): ?>
                    <option value="<?= $categoria->getId() ?>">
                      <?= htmlspecialchars($categoria->getNome()) ?>
                    </option>
    <?php endforeach; ?>
</select>
                    </div>
                    

                </div>
                
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="ordenar">Ordenar por:</label>
                        <select id="ordenar" name="ordenar">
                            <option value="preco_asc">Menor preço</option>
                            <option value="preco_desc">Maior preço</option>
                            <!--<option value="avaliacao">Melhor avaliação</option>-->
                            <option value="mais_vendidos">Mais vendidos</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <button type="submit" class="btn">Filtrar</button>
                        <button type="reset" class="btn btn-secondary">Limpar</button>
                         <div class="back-button">
         <a href="index.php?rota=telaUsuario" class="btn btn-secondary">Voltar</a>
        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="game-list">
    <h2>Resultados da Pesquisa</h2>
    <?php foreach ($dadosView['jogos'] as $jogo): ?>
        <div class="game-item">
            <div class="game-info">
                <div class="game-name"><?= htmlspecialchars($jogo['nome']) ?></div>
            </div>
            <div>
                <span class="game-price">R$ <?= number_format($jogo['preco'], 2, ',', '.') ?></span>

        <form action="index.php?rota=adicionaCarrinho" method="POST">
    <input type="hidden" name="id_jogo" value="<?= $jogo['id'] ?>">
    <input type="hidden" name="nome_jogo" value="<?= htmlspecialchars($jogo['nome']) ?>">
    <input type="hidden" name="preco_jogo" value="<?= $jogo['preco'] ?>">
    <button type="submit" class="btn btn-success">Adicionar ao Carrinho</button>
        </form>
               
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

