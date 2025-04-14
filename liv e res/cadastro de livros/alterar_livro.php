<?php 
include "../conexao.php";

$dado = $_POST['id'];

$livro = $_POST['livro'];
$slug = $_POST['slug'];
$img = $_POST['img_url'];
$isbn = $_POST['isbn'];
$ano = $_POST['ano_publi'];
$editora = $_POST['editora'];
$dimensoes = $_POST['dimensoes'];
$idioma = $_POST['idioma'];
$pag = $_POST['pag'];
$tipo = $_POST['tipo'];
$idade = $_POST['classificacao_idade'];
$genero = $_POST['genero'];
$sinopse = $_POST['sinopse'];
$especifi_livro = $_POST['especifi_livro'];
$preco = $_POST['preco'];
$especifi_pag = $_POST['especifi_pag'];

// Manipula arrays corretamente
$forma_obt = isset($_POST['forma_obt']) && is_array($_POST['forma_obt']) ? implode(", ", $_POST['forma_obt']) : null;
$forma_pag = isset($_POST['forma_pag']) && is_array($_POST['forma_pag']) ? implode(", ", $_POST['forma_pag']) : null;

// Query corrigida
$update = "UPDATE livro SET 
    titulo = ?, 
    slug = ?, 
    imagem_url = ?, 
    isbn = ?, 
    ano_publicacao = ?, 
    editora = ?, 
    dimensoes = ?, 
    idioma = ?, 
    numero_pag = ?, 
    tipo = ?, 
    classificacao_idade = ?, 
    genero = ?, 
    sinopse = ?, 
    especificacao_liv = ?, 
    preco = ?, 
    form_pagamento = ?, 
    forma_obt = ? 
    WHERE id_livro = ?";

// Prepara a query para evitar injeção SQL
$stmt = $conn->prepare($update);
$stmt->bind_param(
    "ssssissssisssssssi",
    $livro, $slug, $img, $isbn, $ano, $editora, $dimensoes, $idioma, $pag, $tipo, $idade, $genero,
    $sinopse, $especifi_livro, $preco, $forma_pag, $forma_obt, $dado
);

// Executa o comando
if ($stmt->execute()) {
    echo "<script>alert('Livro atualizado com sucesso!'); window.location.href = 'cadastro-livros.php';</script>";
} else {
    echo "<script>alert('Erro ao atualizar o livro: {$stmt->error}'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
