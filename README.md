# GameKey

**GameKey** é um sistema de vendas de chaves de jogos digitais, inspirado em plataformas como **Eneba** e **Nuvem**. O sistema permite que usuários simulem a compra de jogos, gerem comprovantes com chaves, adicionem jogos ao carrinho e resgatem os jogos em sua biblioteca. 


---

## Tecnologias Utilizadas

| Categoria           | Ferramenta                                           |
|---------------------|------------------------------------------------------|
| Backend             | PHP                                                  |
| ORM                 | Doctrine (via Composer)                              |
| Banco de Dados      | MySQL                                                |
| Gerenciador BD      | DBeaver                                              |
| Servidor Local      | WAMP                                                 |
| Padrão de Consulta  | Doctrine DQL + PDO                                   |

---

##  Estrutura do Banco de Dados

> **Observação:** No escopo deste sistema, cada jogo pertence a **apenas uma categoria**, por isso **não há** uma tabela de relacionamento `jogo_categoria`.

| Tabela               | Campos                                                                 |
|----------------------|------------------------------------------------------------------------|
| `usuario`            | `id`, `nome`, `email`, `senha`                                         |
| `categoria`          | `id`, `nome`                                                           |
| `jogo`               | `id`, `nome`, `descricao`, `preco`, `id_categoria`                     |
| `carrinho`           | `id`, `id_usuario`, `finalizado`                                       |
| `item_carrinho`      | `id`, `id_carrinho`, `id_jogo`, `preco_unitario`                       |
| `comprovante`        | `id`, `id_usuario`, `data_compra`, `valor_total`, `chave_gerada`, `resgatado` |
| `itemcomprovante`    | `id`, `id_comprovante`, `id_jogo`, `preco_pago`                        |
| `biblioteca_usuario` | `id`, `id_usuario`, `id_jogo`, `data_resgate`                          |



