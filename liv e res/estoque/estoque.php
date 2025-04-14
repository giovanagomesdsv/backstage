<?php 
include "../conexao.php";

session_start();

if (!isset($_SESSION['cnpj'])) {
    header("Location: login.php");
    exit;
}

$cnpj = $_SESSION['cnpj'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
</head>
<body>







<!--barra de pesquisa-->
<div class="pesquisar">
        <form action="" method="GET">
            <input type="text" name="busca" placeholder="Busque os livros...">
            <button type="submit">Pesquisar</button>
        </form>
    </div>

    <div class="estoque">
        <?php
        if (!isset($_GET['busca']) || empty($_GET['busca'])) {
            echo "<div class='resultado'></div>";
        } else {
            $pesquisa = $conn->real_escape_string($_GET['busca']);

            $code = "SELECT titulo, id_livro, escritor.nome, preco, estoque FROM livro 
             INNER JOIN escritor ON escritor.id_escritor = livro.id_escritor WHERE cnpj = '$cnpj'
   AND titulo LIKE '%$pesquisa%'
                            ";

            $sql_consulta = $conn->query($code) or die("Erro ao consultar: " . $conn->error);

            if ($sql_consulta ->num_rows == 0) {
                echo "<div class='resultados'><h3>Nenhum resultado encontrado!</h3></div>";
            } else {
                while ($linha = mysqli_fetch_array($sql_consulta)) {
                    $valor_estoque = $linha['preco'] * $linha['estoque'];
                    echo "
                     <div>
            <p><strong>{$linha['titulo']}</strong></p>
            <p>{$linha['nome']}</p>
            <p>R$ {$linha['preco']}</p>
            <p>Estoque: {$linha['estoque']}</p>
            <p>R$ " . number_format($valor_estoque, 2, ',', '.') . "</p>

            <form action='movimentacao-estoque.php' method='POST'>
                <input type='hidden' name='id' value='{$linha['id_livro']}'>
                <label for='entrada'>Entrada:</label>
                <input type='number' name='entrada'>

                <label for='saida'>Saída:</label>
                <input type='number' name='saida'>

                <input type='submit' value='Salvar'>
            </form>
        </div>
                    ";    
                }
            }
        }



        ?>
    </div>















    <div>
    <?php 
$consulta = "SELECT titulo, id_livro, escritor.nome, preco, estoque FROM livro 
             INNER JOIN escritor ON escritor.id_escritor = livro.id_escritor WHERE cnpj = '$cnpj'";

if ($resp = mysqli_query($conn, $consulta)) {
    while ($estoque = mysqli_fetch_array($resp)) {
        $valor_estoque = $estoque['preco'] * $estoque['estoque'];

        echo "
        <div>
            <p><strong>{$estoque['titulo']}</strong></p>
            <p>{$estoque['nome']}</p>
            <p>R$ {$estoque['preco']}</p>
            <p>Estoque: {$estoque['estoque']}</p>
            <p>R$ " . number_format($valor_estoque, 2, ',', '.') . "</p>

            <form action='movimentacao-estoque.php' method='POST'>
                <input type='hidden' name='id' value='{$estoque['id_livro']}'>
                <label for='entrada'>Entrada:</label>
                <input type='number' name='entrada'>

                <label for='saida'>Saída:</label>
                <input type='number' name='saida'>

                <input type='submit' value='Salvar'>
            </form>
        </div>
        ";
    }
}
?>

    </div>
</body>
</html>