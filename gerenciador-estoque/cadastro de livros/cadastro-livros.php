<?php 
include "../conexao.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Cadastro de livros</title>
</head>
<body>
    <a href="novo-livro.php">
        <div>
            <p>Cadastrar novo livro</p>
        </div>
    </a>

<!--barra de pesquisa-->
    <div class="pesquisar">
        <form action="" method="GET">
            <input type="text" name="busca" placeholder="Busque os livros...">
            <button type="submit">Pesquisar</button>
        </form>
    </div>

    <div class="livros">
        <?php
        if (!isset($_GET['busca']) || empty($_GET['busca'])) {
            echo "<div class='resultado'></div>";
        } else {
            $pesquisa = $conn->real_escape_string($_GET['busca']);

            $code = "SELECT *
    FROM livro 
    INNER JOIN escritor ON escritor.id_escritor = livro.id_escritor 
     WHERE livro.titulo LIKE '%$pesquisa%'
                            ";

            $sql_consulta = $conn->query($code) or die("Erro ao consultar: " . $conn->error);

            if ($sql_consulta ->num_rows == 0) {
                echo "<div class='resultados'><h3>Nenhum resultado encontrado!</h3></div>";
            } else {
                while ($linha = mysqli_fetch_array($sql_consulta)) {
                    echo "
                    <div>
                <div>
                   <img src='img-livro/{$linha['path']}' alt='Foto do livro'>
                    <h3>{$linha['titulo']}</h3>
                    <p> {$linha['nome']}</p>
                    <p>{$linha['visualizacoes']}</p>
                    <p>{$linha['preco']}</p>
                </div>

                 <div>
                    <a href='altera-formulario-livro.php?id={$linha['id_livro']}'>
                        <div class=\"bx bxs-edit-alt\"></div>
                    </a>
                </div>

                <div>
                    <p>{$linha['slug']}</p>
                    <p>{$linha['isbn']}</p>
                    <p>{$linha['ano']}</p>
                    <p>{$linha['editora']}</p>
                    <p>{$linha['dimensoes']}</p>
                    <p>{$linha['idioma']}</p>
                    <p>{$linha['paginas']}</p>
                    <p>{$linha['tipo']}</p>
                    <p>{$linha['classificacao_idade']}</p>
                    <p>{$linha['genero']}</p>
                    <p>{$linha['sinopse']}</p>
                    <p>{$linha['especificacao_liv']}</p>
                    <p>{$linha['preco']}</p>
                    <p>{$linha['forma_pagamento']}</p>
                    <p>{$linha['especificacao_pagamento']}</p>
                    <p>{$linha['forma_obt']}</p>
                    
                </div>
               
            </div>
                    ";    
                }
            }
        }



        ?>
    </div>















    <div>

    <?php 
      session_start();

      $cnpj = $_SESSION['cnpj'];

      $consulta = "
      SELECT 
    livro.id_livro, 
    livro.slug, 
    livro.titulo, 
    livro.path, 
    livro.isbn, 
    livro.ano, 
    livro.editora, 
    livro.dimensoes, 
    livro.idioma, 
    livro.paginas, 
    livro.tipo, 
    livro.classificacao_idade, 
    livro.genero, 
    livro.sinopse, 
    livro.especificacao_livro, 
    livro.preco, 
    livro.forma_pagamento, 
    livro.obs_adicionais, 
    livro.forma_obt, 
    livro.estoque, 
    escritor.nome 
FROM 
    livro 
INNER JOIN 
    escritor 
ON 
    livro.id_escritor = escritor.id_escritor 
WHERE 
    livro.cnpj = '$cnpj';

      ";

      if($resp = mysqli_query($conn, $consulta)) {
        while ($linha = mysqli_fetch_array($resp)) {

            echo "
              <div>
                <div>
                   <img src='img-livro/{$linha['path']}' alt='Foto do livro'>
                    <h3>{$linha['titulo']}</h3>
                    <p> {$linha['nome']}</p>
                    <p>{$linha['preco']}</p>
                </div>

                 <div>
                    <a href='altera-formulario-livro.php?id={$linha['id_livro']}'>
                        <div class=\"bx bxs-edit-alt\"></div>
                    </a>
                </div>

                <div>
                    <p>{$linha['slug']}</p>
                    <p>{$linha['isbn']}</p>
                    <p>{$linha['ano']}</p>
                    <p>{$linha['editora']}</p>
                    <p>{$linha['dimensoes']}</p>
                    <p>{$linha['idioma']}</p>
                    <p>{$linha['paginas']}</p>
                    <p>{$linha['tipo']}</p>
                    <p>{$linha['classificacao_idade']}</p>
                    <p>{$linha['genero']}</p>
                    <p>{$linha['sinopse']}</p>
                    <p>{$linha['especificacao_livro']}</p>
                    <p>{$linha['preco']}</p>
                    <p>{$linha['forma_pagamento']}</p>
                    <p>{$linha['forma_obt']}</p>
                </div>
               
            </div>
            ";

        }
      }
    ?>

    </div>
</body>
</html>