<?php 
include "../conexao.php";

    $dado = isset($_POST['id']) ? $_POST['id'] : null;
    $entrada = isset($_POST['entrada']) ? (int)$_POST['entrada'] : 0;
    $saida = isset($_POST['saida']) ? (int)$_POST['saida'] : 0;

    if (!$dado) {
        echo "<script>alert('ID do livro não informado!'); window.history.back();</script>";
        exit;
    }


    $consulta = "SELECT estoque FROM livro WHERE id_livro = '$dado'";
    $resultado = mysqli_query($conn, $consulta);

    if ($resultado && $dados = mysqli_fetch_assoc($resultado)) {
        $estoque_atual = $dados['estoque'];

        // Calcula o novo estoque
        $estoque_atualiza = $estoque_atual + $entrada - $saida;

        if ($estoque_atualiza < 0) {
            echo "<script>alert('Erro: O estoque não pode ser negativo!'); window.history.back();</script>";
            exit;
        }

        // Atualiza o estoque no banco de dados
        $update = "UPDATE livro SET estoque = '$estoque_atualiza' WHERE id_livro = '$dado'";
        if (mysqli_query($conn, $update)) {
            echo "<script>alert('Estoque atualizado com sucesso!'); window.location.href = 'estoque.php';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar o estoque: " . mysqli_error($conn) . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Erro ao buscar o estoque: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }


mysqli_close($conn);
?>
