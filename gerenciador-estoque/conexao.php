<?php
$hostname = "10.67.22.216";
$banco = "bd_tcc_etim_123_g2";
$usuario = "us_etim_123_g2";
$senha = "ec0623";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_errno) {
    echo "Falha ao conectar(".$conn->connect_errno.") ".$conn->connect_error;
} else {
    echo "Conectado!!!!!!! ";
}
?>