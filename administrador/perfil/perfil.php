<?php
session_start();
include "../conexao-banco/conexao.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php"); // Redireciona para o login se não estiver logado
    exit();
}

$id_usuario = $_SESSION['id'];

$sql = "SELECT usu_email, usu_nome, usu_senha, usu_data_criacao, usu_status FROM usuarios WHERE usu_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            padding: 40px;
        }

        .perfil-container {
            background-color: white;
            max-width: 500px;
            margin: 0 auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }

        .perfil-container h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .perfil-container p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        .status {
            font-weight: bold;
            color: <?= $usuario['usu_status'] ? "green" : "red" ?>;
        }
    </style>
</head>
<body>

    <div class="perfil-container">
        <h1>Perfil do Usuário</h1>
        <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['usu_nome']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($usuario['usu_email']) ?></p>
        <p><strong>Senha:</strong> <?= str_repeat('*', strlen($usuario['usu_senha'])) ?></p>
        <p><strong>Data de Criação:</strong> <?= date("d/m/Y H:i", strtotime($usuario['usu_data_criacao'])) ?></p>
        <p><strong>Status:</strong> <span class="status"><?= $usuario['usu_status'] ? "Ativo" : "Inativo" ?></span></p>
        <a href="editar-perfil.php" style="display: inline-block; margin-top: 20px; background-color: #333; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Editar perfil</a>
    </div>

</body>
</html>
