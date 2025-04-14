
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <form action="inserirlivraria.php" enctype="multipart/form-data" method="POST" name="cadastrolivrarias">
        <h1>CADASTRO DE PARCERIAS</h1>

        <label for="usuario">ID do usuário:</label>
        <input type="text" name="usuario">


        <label for="nome">Nome da livraria:</label>
        <input type="text" name="nome">

        
        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade">

        <label for="estado">Estado:</label>
        <select name="estado" id="estado">
            <option value="">Selecione...</option>
            <option value="SP">SP</option>
            <option value="MG">MG</option>
            <option value="RJ">RJ</option>
        </select>

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" placeholder="Praça da República, 1572">


        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" placeholder="5511987543211">

        <label for="email">E-mail:</label>
        <input type="email" name="email">

        <label for="instagram">Instagram:</label>
        <input type="text" name="instagram" placeholder="URL">

        <label for="perfil">Texto de perfil:</label>
        <input type="text" name="perfil">


        <label for="arquivo">Selecione uma imagem</label>
        <input type="file" name="arquivo">

        <input type="submit" value="cadastrar">

        <a href="livrarias.php">Voltar</a>
    </form>
</body>

</html>