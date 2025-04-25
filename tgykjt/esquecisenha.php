<?php
  include "administrador/conexao-banco/conexao.php";  

  if (isset($_POST[botao])) {

    $novasenha = substr(md5(time()), 0, 6);
  }

  echo substr(md5(time()), 0, 6)


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <input type="email" placeholder="Digite seu e-mail" id="email">
        <input id="botao" name="botao" type="submit">
    </form>
</body>
</html>