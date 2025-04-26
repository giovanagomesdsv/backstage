<?php 
$hostname = "localhost";
$banco = "bd_tcc_etim_123_g2";
$usuario = "root";
$senha = "";

$conn = new mysqli($hostname, $usuario, $senha, $banco);

if ($conn->connect_errno) {
    echo "Falha ao conectar ->" . $conn->connect_errno . " ->" . $conn->connect_error;
} else {
  
}
?>