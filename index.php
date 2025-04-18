<?php
session_start();
include "administrador/conexao-banco/conexao.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

            if ($senha === $usuario_db['usu_senha']) {
                $_SESSION['id'] = $usuario_db['usu_id'];
                $_SESSION['nome'] = $usuario_db['usu_nome'];
                $_SESSION['tipo'] = $usuario_db['usu_tipo_usuario'];

                switch ($usuario_db['usu_tipo_usuario']) {
                    case 0:
                    case 1:
                        header("Location: liv e res/index.php");
                        break;
                    case 2:
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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="administrador/login.css">
    <title>Administrador BC - Login</title>
      <!-- Script -->
      <script>
    document.addEventListener("DOMContentLoaded", function () {
        const proximoBtn = document.getElementById('proximoBtn');
        const tipoSelect = document.getElementById('tipo_usuario');
        const loginContainer = document.getElementById('loginContainer');
        const tipoSelecionado = document.getElementById('tipoSelecionado');
        const cadastroLink = document.getElementById('cadastro-link');
        const resenhistaLink = document.getElementById('resenhista-link');

        proximoBtn.addEventListener('click', function () {
            const tipo = tipoSelect.value;
            if (!tipo) {
                alert("Por favor, selecione o tipo de usuário.");
                return;
            }

            tipoSelecionado.value = tipo;
            loginContainer.style.display = 'block';

            if (tipo === "1") {
                cadastroLink.style.display = 'inline-block';
                resenhistaLink.style.display = 'none';
            } else if (tipo === "0") {
                cadastroLink.style.display = 'none';
                resenhistaLink.style.display = 'inline-block';

                const mensagem = encodeURIComponent("Olá, gostaria de me tornar um resenhista na plataforma BACKSTAGE Community.");
                resenhistaLink.href = `https://wa.me/5514997460253?text=${mensagem}`; 
            } else {
                cadastroLink.style.display = 'none';
                resenhistaLink.style.display = 'none';
            }

            document.querySelector('.select-type').style.display = 'none';
        });
    });
</script>

</head>
<body>
    <div class="container" id="container">

        <!-- Escolha de tipo de usuário -->
        <div class="form-container select-type">
            <form id="tipoForm">
                <h1>Escolha o tipo de usuário</h1>
                <select name="tipo_usuario" id="tipo_usuario" required>
                    <option value="">Selecione o tipo de usuário</option>
                    <option value="2">Administrador</option>
                    <option value="0">Resenhista</option>
                    <option value="1">Livraria</option>
                </select>
                <button type="button" id="proximoBtn" class="btn">Próximo</button>
            </form>
        </div>

        <!-- Formulário de login (inicialmente escondido) -->
        <div class="form-container sign-in" id="loginContainer" style="display: none;">
            <form action="" method="POST" name="form1">
                <h1>Entrar</h1>
                <input type="hidden" name="tipo_usuario" id="tipoSelecionado">
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>

                <a href="esquecisenha.php" style="color: #000">Esqueci a senha</a>
                <button class="btn">Entrar</button>

                <!-- Links dinâmicos -->
                <a id="cadastro-link" href="cadastrarusu-livraria.php" style="display: none; color: #000; margin-top: 10px;">Criar conta como livraria</a>
                <a id="resenhista-link" href="#" target="_blank" style="display: none; color: #000; margin-top: 10px;">Quero me tornar um resenhista</a>
            </form>
        </div>

        <!-- Painel fixo -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Olá, você está acessando BACKSTAGE Community!</h1>
                    <p></p>
                </div>
            </div>
        </div>
    </div>

  
</body>
</html>
