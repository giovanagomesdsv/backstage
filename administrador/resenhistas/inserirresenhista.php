<?php
include "../conexao-banco/conexao.php";
                  
$id = $_POST['id'];
$pseudonimo = $_POST['pseudonimo'];
$descricao = $_POST['descricao'];                
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];                          
$telefone = $_POST['telefone'];                
$instagram = $_POST['instagram'];                          
                             

if (isset($_FILES['arquivo'])) {
    $arquivo = $_FILES['arquivo'];

    if ($arquivo['error'])
        die("Falha ao enviar arquivo");

    if ($arquivo['size'] > 2097152) 
        die("Arquivo muito grande! Max: 2MB");


        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
        $pasta = "../imagens/resenhistas/";

    if($extensao != "jpg" && $extensao != 'png')
       die("Tipo de arquivo não aceito!");

       $path =  $novoNomeDoArquivo . "." . $extensao;

       $caminho =  $pasta . $novoNomeDoArquivo . "." . $extensao;

       $deu_certo = move_uploaded_file($arquivo["tmp_name"],  $caminho);
}

$sql_code = "INSERT INTO resenhistas ( res_id, res_nome_fantasia, res_cidade, res_estado, res_telefone  ,  res_foto, res_perfil, res_social ) VALUES ( '$id', '$pseudonimo',  '$cidade', '$estado', '$telefone', '$path', '$descricao', '$instagram')";

if (mysqli_query($conn, $sql_code)) {
    echo '
    <script>
         window.alert("Dados inseridos com sucesso!");
         location.href="resenhistas.php";
    </script>
    ';
} else {
    echo '
    <script>
         window.alert("Erro na inserção!");
         location.href="inserirresenhista.php";
    </script>
    ';
};
?>