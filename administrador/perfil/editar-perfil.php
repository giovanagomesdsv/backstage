<!--<?php
session_start();
include "../conexao-banco/conexao.php";

// Redireciona caso o usuário não esteja logado
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_SESSION['id'];
$mensagem = "";
$tipo_mensagem = ""; // 'sucesso' ou 'erro'

// Lógica de atualização ao submeter o formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $novo_nome  = trim($_POST['nome']);
    $novo_email = trim($_POST['email']);
    $nova_senha = trim($_POST['senha']);

    if (!empty($novo_nome) && !empty($novo_email)) {
        // Validação do e-mail
        if (!filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
            $mensagem = "Email inválido.";
            $tipo_mensagem = "erro";
        } else {
            // Atualiza com a senha, caso a nova senha tenha sido fornecida
            if (!empty($nova_senha)) {
                $senha_hash = password_hash($nova_senha, PASSWORD_BCRYPT);
                $sql = "UPDATE usuarios SET usu_nome = ?, usu_email = ?, usu_senha = ? WHERE usu_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $novo_nome, $novo_email, $senha_hash, $id);
            } else {
                // Se a senha não for fornecida, não atualiza a senha
                $sql = "UPDATE usuarios SET usu_nome = ?, usu_email = ? WHERE usu_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssi", $novo_nome, $novo_email, $id);
            }

            if ($stmt->execute()) {
                $_SESSION['nome'] = $novo_nome;
                echo "<script>alert('Perfil atualizado com sucesso!'); window.location.href = 'perfil.php';</script>";
                exit();
            } else {
                $mensagem = "Erro ao atualizar perfil.";
                $tipo_mensagem = "erro";
            }

            $stmt->close();
        }
    } else {
        $mensagem = "Nome e e-mail são obrigatórios.";
        $tipo_mensagem = "erro";
    }
}

// Busca os dados atuais do usuário
$sql = "SELECT usu_nome, usu_email FROM usuarios WHERE usu_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();
?>
-->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
</head>
<body>
    <!-- Exibe mensagens de erro -->
    <?php if (!empty($mensagem)): ?>
        <script>alert("<?= htmlspecialchars($mensagem) ?>");</script>
    <?php endif; ?>

    <h1>Editar Perfil</h1>
    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($usuario['usu_nome']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($usuario['usu_email']) ?>" required><br><br>

        <label>Nova senha:</label><br>
        <input type="password" name="senha" placeholder="Deixe em branco para manter"><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
    <br>
    <a href="perfil.php">Voltar ao perfil</a>
</body>
</html>
