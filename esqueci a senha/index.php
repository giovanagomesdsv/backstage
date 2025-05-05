<?php 
include("../administrador/conexao-banco/conexao.php");

$erro = [];

if (isset($_POST['ok'])) {
    $email = $mysqli->escape_string($_POST['email']);

    // Validação do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro[] = "E-mail inválido";
    }

    // Verifica se o e-mail existe
    $sql = "SELECT * FROM usuarios WHERE usu_email = '$email'";
    $query = $mysqli->query($sql) or die($mysqli->error);
    $usuario = $query->fetch_assoc();

    if ($query->num_rows == 0) {
        $erro[] = "E-mail não encontrado no sistema.";
    }

    // Se tudo certo
    if (count($erro) == 0) {
        $novaSenha = substr(md5(time()), 0, 6); // Gera senha temporária
        $senhaAtualizada = $novaSenha; // Use password_hash() se preferir segurança

        $sql = "UPDATE usuarios SET usu_senha = '$senhaAtualizada' WHERE usu_email = '$email'";
        if ($mysqli->query($sql)) {
            echo "<p style='color:green;'>Sua nova senha temporária é: <strong>$novaSenha</strong></p>";
            echo "<p style='color:blue;'>Use-a para fazer login e altere sua senha depois.</p>";
        } else {
            echo "<p style='color:red;'>Erro ao atualizar a senha. Tente novamente.</p>";
        }
    } else {
        foreach ($erro as $msg) {
            echo "<p style='color:red;'>$msg</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
</head>
<body>
    <form action="" method="post">
        <input name="email" placeholder="Seu e-mail" type="email" required>
        <input name="ok" value="Enviar" type="submit">
    </form>
</body>
</html>
