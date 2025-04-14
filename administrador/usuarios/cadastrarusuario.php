<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="cadastrarusuario.css">
</head>
<body style="background-color:#DEDEDE">
    <form action="cadastrar.php" method="POST">

    <label for="email">E-mail:</label>
        <input type="email" name="email" >

        <label for="nome">Nome:</label>
        <input type="text" name="nome">

        <label for="senha">Senha:</label>
        <input type="text" name="senha">

        <label for="usuario">Tipo de usuário:</label>
        <select name="usuario" id="usuario" required>
            <option value="">Selecione...</option>
            <option value="2">Administrador</option>
            <option value="1">Livraria</option>
            <option value="0">Resenhista</option>
        </select>
        <input type="submit" value="Cadastrar usuário">
    </form>
</body>
</html>