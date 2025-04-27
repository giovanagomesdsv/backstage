<?php
include "administrador/conexao-banco/conexao.php";

// Recebendo os dados do formulário
$id_usuario = $_POST['id_usuario']; // Aqui você pega o ID do usuário
$nome = $_POST['nome'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$instagram = $_POST['instagram'];
$perfil = $_POST['perfil'];
$path = ""; // Inicializa o path vazio

// Tratando o envio da imagem
if (isset($_FILES['arquivo'])) {
    $arquivo = $_FILES['arquivo'];

    if ($arquivo['error'])
        die("Falha ao enviar arquivo.");

    if ($arquivo['size'] > 2097152) // 2MB
        die("Arquivo muito grande! Máximo: 2MB");

    $nomeDoArquivo = $arquivo['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    $pasta = "administrador/imagens/livrarias/";

    if ($extensao != "jpg" && $extensao != "png")
        die("Tipo de arquivo não aceito!");

    $path = $novoNomeDoArquivo . "." . $extensao;
    $caminho = $pasta . $path;

    $deu_certo = move_uploaded_file($arquivo["tmp_name"], $caminho);
}

// Agora sim o INSERT com o ID do usuário:
$sql_code = "INSERT INTO LIVRARIAS 
(liv_id, liv_nome, liv_cidade, liv_estado, liv_endereco, liv_telefone, liv_email, liv_foto, liv_perfil, liv_social) 
VALUES 
('$id_usuario', '$nome', '$cidade', '$estado', '$endereco', '$telefone', '$email', '$path', '$perfil', '$instagram')";

if (mysqli_query($conn, $sql_code)) {
    echo '
    <script>
         alert("Livraria cadastrada com sucesso!");
         location.href="index.php";
    </script>
    ';
} else {
    echo '
    <script>
         alert("Erro ao cadastrar livraria!");
         location.href="cadastrar-livraria.php?id_usuario='.$id_usuario.'";
    </script>
    ';
}
?>
