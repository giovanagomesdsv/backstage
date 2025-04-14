<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de resenhistas</title>
</head>
<body>
<form action="inserirresenhista.php" enctype="multipart/form-data" method="POST" name="cadastroresenhista">
        <h1>CADASTRO DE RESENHISTAS</h1>

        <label for="id">Id:</label>
        <input type="text" name="id"> 

        <label for="pseudonimo">Pseudonimo:</label>
        <input type="text" name="pseudonimo">    

        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade">

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="">Selecione...</option>
            <option value="SP">SP</option>
            <option value="MG">MG</option>
            <option value="RJ">RJ</option>
        </select>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" placeholder="5511987543211">

        <label for="instagram">Instagram:</label>
        <input type="text" name="instagram" placeholder="URL">

        <label for="descricao">Perfil:</label>
        <input type="text" name="descricao">

        <label for="arquivo">Selecione uma imagem</label>
        <input type="file" name="arquivo" >

        <input type="submit" value="cadastrar">

        <a href="resenhistas.php">Voltar</a>
    </form>
</body>
</html>