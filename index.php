<?php
/*
        if ($result->num_rows === 1) {
            $usuario_db = $result->fetch_assoc();

            if (password_verify($senha, $usuario_db['usu_senha'])) {
                $_SESSION['id'] = $usuario_db['usu_id'];
                $_SESSION['nome'] = $usuario_db['usu_nome'];

                header("Location: home.php");
                exit();
            } else {
                echo "Falha ao logar! Senha incorreta.";
            }
        } else {
            echo "Falha ao logar! E-mail incorreto.";
        }
*/

session_start();
include "administrador/conexao-banco/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'], $_POST['senha'], $_POST['tipo_usuario'])) {

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $tipo_usuario = (int)$_POST['tipo_usuario'];

    if (empty($email) || empty($senha) || $_POST['tipo_usuario'] === "") {
        echo "Preencha todos os campos.";
    } else {
        $sql_code = "SELECT * FROM usuarios WHERE usu_email = ? AND usu_tipo_usuario = ? AND usu_status = 1";
        $stmt = $conn->prepare($sql_code);
        $stmt->bind_param("si", $email, $tipo_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $usuario_db = $result->fetch_assoc();

            if ($senha === $usuario_db['usu_senha']) { // ou use password_verify()
                $_SESSION['id'] = $usuario_db['usu_id'];
                $_SESSION['nome'] = $usuario_db['usu_nome'];
                $_SESSION['tipo'] = $usuario_db['usu_tipo_usuario'];

                // Redirecionamento com base no tipo
                switch ($usuario_db['usu_tipo_usuario']) {
                    case 0: // Resenhista
                        header("Location: liv e res/index.php");
                        break;
                    case 1: // Livraria
                        header("Location: liv e res/index.php");
                        break;
                    case 2: // Administrador
                        header("Location: administrador/home.php");
                        break;
                    default:
                        echo "Tipo de usuário inválido.";
                }

                exit();
            } else {
                echo "Falha ao logar! Senha incorreta.";
            }
        } else {
            echo "Falha ao logar! E-mail incorreto ou usuário não autorizado.";
        }

        $stmt->close();
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="login.css">
    <title>Administrador BC - Login</title>
</head>

<body>
    <div class="container" id="container">

        <div class="form-container sign-in">
            <form action="" method="POST" name="form1">
                <h1>Entrar</h1>
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>

                <select name="tipo_usuario" required>
                        <option value="">Selecione o tipo de usuário</option>
                        <option value="2">Administrador</option>
                        <option value="0">Resenhista</option>
                        <option value="1">Livraria</option>
                </select>

                <a href="" style="color: #fff">Esqueci a senha</a>
                <button class="btn">Entrar</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Olá, você está acessando o site Administrador do BIBLIÓFILOS Community!</h1>
                    <p>É necessário que um administrador já cadastrado realize o cadastro de um novo colaborador.</p>
                </div>
            </div>
        </div>
    </div>


</body>

</html>