<?php
  $tipo_usuario = $_POST['tipo_usuario'];
  
  if ($tipo_usuario == 0) {
    header("Location: resenhistas.php");
    exit();
} else if ($tipo_usuario == 1) {
    header("Location: livrarias.php");
    exit();
}else {
    header("Location: adm.php");
    exit();
}



?>