<?php
include("conexao-banco/conexao.php");

$erro = [];

if (isset($_POST['ok'])) {
    $email = $mysqli->escape_string($_POST['email']);

    // Validação do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro[] = "E-mail inválido";
    }

    // Verifica se existe e busca o número do WhatsApp
    $sql = "
        SELECT l.livr_whatsapp 
        FROM usuarios u
        JOIN livrarias l ON u.usu_id = l.livr_id
        WHERE u.usu_email = '$email'
    ";
    $query = $mysqli->query($sql) or die($mysqli->error);
    $dados = $query->fetch_assoc();

    if ($query->num_rows == 0) {
        $erro[] = "E-mail não encontrado no sistema.";
    }

    if (count($erro) == 0) {
        $novaSenha = substr(md5(time()), 0, 6);
        $senhaCriptografada = $novaSenha; // ou password_hash($novaSenha, PASSWORD_DEFAULT);

        // Atualiza a senha no banco
        $update = "UPDATE usuarios SET usu_senha = '$senhaCriptografada' WHERE usu_email = '$email'";
        if ($mysqli->query($update)) {
            // Envia por WhatsApp com CallMeBot
            $numero = preg_replace('/[^0-9]/', '', $dados['livr_whatsapp']); // limpa caracteres
            $mensagem = urlencode("Sua nova senha temporária é: $novaSenha");

            $apikey = "SEU_APIKEY_AQUI"; // substitua pela sua chave
            $url = "https://api.callmebot.com/whatsapp.php?phone=$numero&text=$mensagem&apikey=$apikey";

            $resposta = file_get_contents($url);

            echo "<p style='color:green;'>A nova senha foi enviada para o WhatsApp cadastrado.</p>";
        } else {
            echo "<p style='color:red;'>Erro ao atualizar a senha.</p>";
        }
    } else {
        foreach ($erro as $msg) {
            echo "<p style='color:red;'>$msg</p>";
        }
    }
}
?>
