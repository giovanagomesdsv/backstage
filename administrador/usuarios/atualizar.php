<?php
include "../conexao-banco/conexao.php";
  $dado= $_GET['id'];
  $status = $_POST['status'];
  
  $update = "UPDATE USUARIOS SET usu_status=' $status'  WHERE usu_id= '$dado'";

  if($resp = mysqli_query($conn, $update)) {
    echo "
    <script>
      window.alert('Status atualizado com sucesso!');
      location.href = 'usuarios.php';
    </script>
    ";
} else {
    echo "
    <script>
      window.alert('Erro na atualização!');
      location.href = 'editarusuario.php';
    </script>
    ";
}

?>