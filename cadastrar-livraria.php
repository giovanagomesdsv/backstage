<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="administrador/usuarios/cadastrarusuario.css">
</head>

<body style="background-color:#DEDEDE">
    <form action="inserir-livraria.php" method="POST" enctype="multipart/form-data">
        <!-- Campo escondido para o ID do usuário -->
        <input type="hidden" name="id_usuario" value="<?php echo $_GET['id_usuario']; ?>">

        <label for="nome">Nome da livraria:</label>
        <input type="text" name="nome" required>

        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" required>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="">Selecione...</option>
            <option value="SP">SP</option>
            <option value="MG">MG</option>
            <option value="RJ">RJ</option>
        </select>

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" required>

        <label for="telefone">Telefone:</label>
        <input type="number" name="telefone" placeholder="11987543211" required>

        <label for="email">E-mail da livraria:</label>
        <input type="email" name="email" required>

        <label for="arquivo">Selecione uma imagem:</label>
        <input type="file" name="arquivo" required>

        <label for="perfil">Perfil:</label>
        <input type="text" name="perfil" required>

        <label for="instagram">Instagram:</label>
        <input type="text" name="instagram" placeholder="URL" required>

        <input type="submit" value="Cadastrar livraria">
    </form>

</body>

</html>