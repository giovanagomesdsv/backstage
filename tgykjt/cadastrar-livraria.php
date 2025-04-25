<?php
include "../conexao-banco/conexao.php";
    $email = $_POST['email'];
    $nome = $_POST['nome'];
   /* $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);*/
    $senha = $_POST['senha'];
    $usuario = 1;

    $sql_code = "INSERT INTO USUARIOS ( usu_nome, usu_email, usu_senha, usu_tipo_usuario) VALUES (' $nome', '$email',  '$senha',  '$usuario')";


if (mysqli_query($conn, $sql_code)) {
    echo '
    <script>
         window.alert("Dados inseridos com sucesso!");
         location.href="usuarios.php";
    </script>
    ';
} else {
    echo '
    <script>
         window.alert("Erro na inserção!");
         location.href="cadastrarusuario.php";
    </script>
    ';
};

?>