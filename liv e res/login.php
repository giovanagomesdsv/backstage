<?php 
include "conexao.php";

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cnpj = $_POST['cnpj'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados
    $sql = "SELECT * FROM parceria WHERE cnpj = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cnpj);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $parceria = $result->fetch_assoc();
        if (password_verify($senha, $parceria['senha'])) {
            // Login bem-sucedido
            $_SESSION['cnpj'] = $parceria['cnpj'];
            $_SESSION['nome'] = $parceria['nome'];
            header("Location: painel.php");
            exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "CNPJ não encontrado.";
    }
}
?>