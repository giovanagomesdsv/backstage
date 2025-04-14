<?php
include "conexao-banco/conexao.php";
  $dado = $_GET['id'];

  $SELECT = "SELECT  resenha_id, resenha_titulo,resenha_texto, livro_sinopse, livro_foto, res_nome_fantasia FROM resenhas INNER JOIN LIVROS on resenhas.livro_id = livros.livro_id INNER JOIN RESENHISTAS ON resenhistas.res_id = resenhas.res_id WHERE resenha_id= '$dado';
";

  if ($resp = mysqli_query($conn, $SELECT)) {
   while( $row = mysqli_fetch_array($resp) ){
    echo "
               

    <!DOCTYPE html>
<html lang='pt-br'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
   
<title>Avaliar resenha</title>
</head>
<body>

  <p class='avaliaresenha'>ㅤㅤㅤㅤㅤAVALIAR RESENHAㅤㅤㅤㅤㅤ</p>
 
 
  <div class='cardazul'>
      <div class='imgtitulo'>
        <img src='imagens/livros/{$row['livro_foto']}' alt=''>
      </div>

     <div class='cardbranco1'>
        <p>{$row['livro_sinopse']}</p>
     </div>

     <p>{$row['resenha_titulo']}</p>
  
  </div>
  
      <p>RESENHA</p>
  <div class='cardbranco2'>
      <p>{$row['resenha_texto']}</p>
  </div>
      <p>{$row['res_nome_fantasia']}</p>


<form action='enviar-avaliacao.php?id={$dado}' method='post' class='cardforms'>
    <select name='avaliar' required>
        <option value=''>Avaliar</option>
        <option value='1'>Reprovada</option>
        <option value='3'>Corrigir</option>
        <option value='2'>Aprovada</option>
    </select>
    <input type='submit' value='enviar'>
 
</form>

</div>
</body>
</html>

";
    }
  }

?>

</body>
</html>