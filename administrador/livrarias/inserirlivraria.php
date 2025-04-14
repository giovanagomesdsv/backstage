<?php
include "../conexao-banco/conexao.php";


$usuario = $_POST['usuario'];                                                 
$nome = $_POST['nome'];                     
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];   
$endereco = $_POST['endereco'];                        
$telefone = $_POST['telefone'];                
$email = $_POST['email'];
$instagram = $_POST['instagram'];                          
$perfil = $_POST['perfil'];                          
  

if (isset($_FILES['arquivo'])) {
    $arquivo = $_FILES['arquivo'];

    if ($arquivo['error'])
        die("Falha ao enviar arquivo");

    if ($arquivo['size'] > 2097152) 
        die("Arquivo muito grande! Max: 2MB");


        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
        $pasta = "../imagens/livrarias/";

    if($extensao != "jpg" && $extensao != 'png')
       die("Tipo de arquivo não aceito!");

       $path =  $novoNomeDoArquivo . "." . $extensao;

       $caminho =  $pasta . $novoNomeDoArquivo . "." . $extensao;

       $deu_certo = move_uploaded_file($arquivo["tmp_name"],  $caminho);
}

$sql_code = "INSERT INTO LIVRARIAS (liv_id,liv_nome,liv_cidade,liv_estado,liv_endereco,liv_telefone,liv_email,liv_foto,liv_perfil,liv_social) VALUES ('$usuario', '$nome', '$cidade', '$estado', '$endereco',  '$telefone', '$email', '$path', '$perfil', '$instagram'  )";


if (mysqli_query($conn, $sql_code)) {
    echo '
    <script>
         window.alert("Dados inseridos com sucesso!");
         location.href="livrarias.php";
    </script>
    ';
} else {
    echo '
    <script>
         window.alert("Erro na inserção: ' . mysqli_error($conn) . '");
         location.href="livrarias.php";
    </script>
    ';
};
?>