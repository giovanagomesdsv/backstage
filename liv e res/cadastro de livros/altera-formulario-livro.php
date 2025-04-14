<?php
include "../conexao.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar livro</title>
</head>

<body>
    <?php
    $dado = $_GET['id']; 

    $consulta = "SELECT * FROM livro WHERE id_livro='$dado'";

    if ($resultado = mysqli_query($conn, $consulta)) {
        while ($linha = mysqli_fetch_array($resultado)) {

            echo "
             <form action='alterar_livro.php' method='POST'>
        <label for='livro'>Nome do livro:</label>
        <input type='text' name='livro' value='{$linha['titulo']}'>


        
        <label for='autor'>Id do autor:</label>
        <input type='text' name='autor' value='{$linha['id_escritor']}'>

        
        <label for='id'>Id do livro:</label>
        <input type='text' name='id' value='{$linha['id_livro']}'>



        <label for='slug'>Slug do livro:</label>
        <input type='text' name='slug' value='{$linha['slug']}'>



        <label for='img_url'>Imagem do livro:</label>
        <input type='text' name='img_url' value='{$linha['imagem_url']}'>



        <label for='isbn'>ISBN:</label>
        <input type='text' name='isbn' value='{$linha['isbn']}'>


        <label for='ano_publi'>Ano de publicação:</label>
        <input type='number' name='ano_publi' value='{$linha['ano_publicacao']}'>



        <label for='editora'>Editora:</label>
        <input type='text' name='editora' value='{$linha['editora']}' >



        <label for='dimensoes'>Dimensões:</label>
        <input type='text' name='dimensoes' value='{$linha['dimensoes']}'>

        <label for='idioma'>Idioma:</label>
<input type='text' name='idioma' value='{$linha['idioma']}'>

<label for='pag'>Número de páginas:</label>
<input type='number' name='pag' value='{$linha['numero_pag']}'>

<label for='tipo'>Tipo de Livro:</label>
<select name='tipo'  required>
    <option value='{$linha['tipo']}'>{$linha['tipo']}</option>
    <option value='Capa dura'>Capa dura</option>
    <option value='Espiral'>Espiral</option>
    <option value='Livro brochura'>Livro brochura</option>
    <option value='Livro de bolso'>Livro de bolso</option>
    <option value='Pop-up books'>Pop-up books</option>
    <option value='Livro interativo'>Livro interativo</option>
    <option value='Livros ilustrados'>Livros ilustrados</option>
    <option value='Livros em braile'>Livros em braile</option>
    <option value='Livros de luxo'>Livros de luxo</option>
    <option value='Livros personalizados'>Livros personalizados</option>
    <option value='Livros de colecionador'>Livros de colecionador</option>
    <option value='Graphic novels'>Graphic novels</option>
    <option value='Mangás'>Mangás</option>
    <option value='Novelas gráficas'>Novelas gráficas</option>
    <option value='Livros de bolso com zíper ou capa protetora'>Livros de bolso com zíper ou capa protetora</option>
</select>

<label for='classificacao_idade'>Classificação de Idade:</label>
<select name='classificacao_idade' required>
    <option value=''>{$linha['classificacao_idade']}</option>
    <option value='Livre'>Livre</option>
    <option value='10+'>10+</option>
    <option value='12+'>12+</option>
    <option value='16+'>16+</option>
    <option value='18+'>18+</option>
</select>

<label for='genero'>Gênero:</label>
<select name='genero'  required>
    <option value=''>{$linha['genero']}</option>
    <option value='Romance'>Romance</option>
    <option value='Fantasia e Ficção'>Fantasia e Ficção</option>
    <option value='Suspense e Mistério'>Suspense e Mistério</option>
    <option value='Terror'>Terror</option>
    <option value='Clássicos'>Clássicos</option>
    <option value='Aventura'>Aventura</option>
    <option value='Drama'>Drama</option>
    <option value='Administração'>Administração</option>
    <option value='Autoajuda'>Autoajuda</option>
    <option value='Arte, Cinema e Fotografia'>Arte, Cinema e Fotografia</option>
    <option value='Artesanato, Casa e Estilo de Vida'>Artesanato, Casa e Estilo de Vida</option>
    <option value='Biografias e Casos Verdadeiros'>Biografias e Casos Verdadeiros</option>
    <option value='Computação, Informática e Mídias Digitais'>Computação, Informática e Mídias Digitais</option>
    <option value='Direito Profissional e Técnico'>Direito Profissional e Técnico</option>
    <option value='Educação, Referência e Didáticos'>Educação, Referência e Didáticos</option>
    <option value='Erótico'>Erótico</option>
    <option value='Esportes e Lazer'>Esportes e Lazer</option>
    <option value='Gastronomia e Culinária'>Gastronomia e Culinária</option>
    <option value='HQs, Mangás e Graphic Novels'>HQs, Mangás e Graphic Novels</option>
    <option value='Humor e Entretenimento'>Humor e Entretenimento</option>
    <option value='Inglês e Outras Linguas'>Inglês e Outras Linguas</option>
    <option value='Livros de Ciências, Matemática e Tecnologia'>Livros de Ciências, Matemática e Tecnologia</option>
    <option value='Livros Infantis'>Livros Infantis</option>
    <option value='Medicina Profissional e Técnico'>Medicina Profissional e Técnico</option>
    <option value='Negócios e Economia'>Negócios e Economia</option>
    <option value='Política e Ciências Sociais'>Política e Ciências Sociais</option>
    <option value='Religião e Espiritualidade'>Religião e Espiritualidade</option>
    <option value='Saúde e Familia'>Saúde e Familia</option>
    <option value='Viagens'>Viagens</option>
</select>

<label for='sinopse'>Sinopse:</label>
<input type='text' name='sinopse' value='{$linha['sinopse']}'>

<label for='especifi_livro'>Especificação do livro:</label>
<input type='text' name='especifi_livro' value='{$linha['especificacao_liv']}'>

<label for='preco'>Preço:</label>
<input type='number' step='0.01' name='preco' value='{$linha['preco']}' required>


<label for='forma_pag'>Forma de pagamento:</label>
<input type='checkbox' name='forma_pag[]' value='Cartão de crédito'> Cartão de crédito
<input type='checkbox' name='forma_pag[]' value='Cartão de crédito (presencialmente)'> Cartão de crédito (presencialmente)
<input type='checkbox' name='forma_pag[]' value='cartão de débito'> cartão de débito
<input type='checkbox' name='forma_pag[]' value='Cartão de débito (presencialmente)'> Cartão de débito (presencialmente)
<input type='checkbox' name='forma_pag[]' value='pix'> pix
<input type='checkbox' name='forma_pag[]' value='transferência bancaria'> transferência bancaria
<input type='checkbox' name='forma_pag[]' value='dinheiro em espécie (presencialmente)'> dinheiro em espécie (presencialmente)
<input type='checkbox' name='forma_pag[]' value='boleto'> boleto

<label for='especifi_pag'>Especificação de pagamento:</label>
<input type='text' name='especifi_pag' value='{$linha['especificacao_pagamento']}'>


<label for='forma_obt'>Forma de obtenção:</label>
<input type='checkbox' name='forma_obt[]' value='retirada no local'> retirada no local
<input type='checkbox' name='forma_obt[]' value='entrega por correio'> entrega por correio
<input type='checkbox' name='forma_obt[]' value='entrega por conta da loja'> entrega por conta da loja

<label for='especifi_obt'>Especificação de obtenção:</label>
<input type='text' name='especifi_obt' value='{$linha['especificação_obt']}'>

<input type='submit' value='enviar'>

    </form>
            ";
        }
    } else {
        // Mostra o erro caso a consulta falhe
        echo "Erro na consulta: " . mysqli_error($conn);
    }
    ?>




</body>

</html>