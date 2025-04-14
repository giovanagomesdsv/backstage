<?php
include "conexao-banco/conexao.php";
    $dado = $_GET['id'];
    $avaliar = $_POST['avaliar'];

    $UPDATE = "UPDATE RESENHAS SET resenha_status = ? WHERE resenha_id = ?";


    $stmt = $conn->prepare($UPDATE);
    $stmt->bind_param("ii", $avaliar, $dado);


// Executa o comando
if ($stmt->execute()) {
    echo "<script>alert('Avaliado com sucesso!'); window.location.href = 'home.php';</script>";
}

?>