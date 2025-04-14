<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="editarusuario.css">
</head>
<body>

<?php
include "../conexao-banco/conexao.php";

  $dado = $_GET['id'];
  
  $consulta = "SELECT usu_status FROM USUARIOS WHERE usu_id = '$dado'";

  if($resp = mysqli_query($conn, $consulta)) {

    while ($row = mysqli_fetch_array($resp)) {
         
        echo "

         <form action='atualizar.php?id=$dado' method='POST'>
    <label for='status'>Status:</label>
        <select name='status' id='status' required>
            <option value=''>{$row['usu_status']}</option>
            <option value='1'>ATIVO</option>
            <option value='0'>DESATIVADO</option>
        </select>
        <input type='submit' value='Enviar'>
    </form>
        ";
    }
  }

?>
   
</body>
</html>