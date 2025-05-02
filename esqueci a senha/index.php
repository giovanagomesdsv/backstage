<?php 
include("conexao-banco/conexao.php");

$erro = array();

if (isset($_POST['ok'])) {
    $email = $mysqli->escape_string($_POST['email']);

    // Validação do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro[] = "E-mail inválido";
    }

    // Verifica se o e-mail existe no banco
    $sql_code = "SELECT usu_senha FROM usuarios WHERE usu_email = '$email'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dado = $sql_query->fetch_assoc();
    $total = $sql_query->num_rows;

    if ($total == 0) {
        $erro[] = "O e-mail informado não existe no banco de dados";
    }

    // Se não houver erro
    if (count($erro) == 0) {
        $novasenha = substr(md5(time()), 0, 6); // gerar nova senha
        $nscriptografada = $novasenha; // sem criptografia para testes

        // Envia o e-mail com a nova senha
        if (mail($email, "Sua nova senha", "Sua nova senha: " . $novasenha)) {
            $sql_code = "UPDATE usuarios SET usu_senha = '$nscriptografada' WHERE usu_email = '$email'";
            $mysqli->query($sql_code) or die($mysqli->error);
            echo "<p style='color:green;'>Uma nova senha foi enviada para seu e-mail.</p>";
        } else {
            echo "<p style='color:red;'>Erro ao enviar o e-mail. Contate o suporte.</p>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
</head>
<body>
    <form action="" method="post">
        <input name="email" placeholder="Seu e-mail" type="email" id="email" required>
        <input name="ok" value="ok" type="submit">
    </form>
</body>
</html>
