<?php
include "../conexao-banco/conexao.php";
    $dado = $_GET['id'];
    $avaliar = $_POST['avaliar'];

    $UPDATE = "UPDATE usuarios SET usu_status = ? WHERE usu_id = ?";



    $stmt = $conn->prepare($UPDATE);
    $stmt->bind_param("ii", $avaliar, $dado);


// Executa o comando
if ($stmt->execute()) {
    echo "<script>alert('Avaliado com sucesso! Não se esqueça de avisar o novo usuário pelo email.'); window.location.href = '../home.php';</script>";
}
?>