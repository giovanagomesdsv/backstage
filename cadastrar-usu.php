<?php
include "administrador/conexao-banco/conexao.php";

// Pegando os dados enviados pelo formulário
$email = $_POST['email'];
$nome = $_POST['nome'];
/* $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);*/
$senha = $_POST['senha'];
$usuario = 1; // tipo de usuário

// Inserindo no banco
$sql_code = "INSERT INTO USUARIOS (usu_nome, usu_email, usu_senha, usu_tipo_usuario) 
VALUES ('$nome', '$email', '$senha', '$usuario')";

if (mysqli_query($conn, $sql_code)) {
    // Pegando o ID recém inserido
    $ultimo_id = mysqli_insert_id($conn);

    echo '
    <script>
         alert("Usuário cadastrado com sucesso!");
         location.href="cadastrar-livraria.php?id_usuario='.$ultimo_id.'";
    </script>
    ';
} else {
    echo '
    <script>
         alert("Erro ao cadastrar usuário!");
         location.href="cadastrar-usuario.php";
    </script>
    ';
};
?>
