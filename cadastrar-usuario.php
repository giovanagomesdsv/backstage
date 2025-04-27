<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="administrador/usuarios/cadastrarusuario.css">
</head>
<body style="background-color:#DEDEDE">
    <form action="cadastrar-usu.php" method="post">

    <label for="email">E-mail do administrador:</label>
        <input type="email" name="email" >

        <label for="nome">Nome do adminiatrador:</label>
        <input type="text" name="nome">

        <label for="senha">Senha:</label>
        <input type="text" name="senha">

        <input type="submit" value="Cadastrar usuário">
    </form>
</body>
</html>