<?php
include "protecao.php";
include "conexao-banco/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="geral.css">

    <title>ADM BC - Home</title>

</head>
<style>

</style>

<body>
    <header>
        Administrador BC
    </header>
    <nav class="sidebar" id="sidebar">
        <div class="nome">
            <div class="logo_name"> <?php echo $_SESSION['nome']; ?></div>
            <div class="menu" id="menu">
                <i class="bx bx-menu"></i>
            </div>

        </div>
        <ul class="nav-list">
            <li class="fix">
                <a href="home.php">
                    <i class='bx bx-home-alt-2'></i>
                    <span class="link_name">Home</span>
                </a>
            </li>
            <li>
                <a href="livrarias/livrarias.php">
                    <i class='bx bx-user'></i>
                    <span class="link_name">Livrarias</span>
                </a>
            </li>
            <li>
                <a href="resenhistas/resenhistas.php">
                    <i class='bx bx-user-pin'></i>
                    <span class="link_name">Resenhistas</span>
                </a>
            </li>
            <li>
                <a href="livro/livros.php">
                    <i class='bx bx-book-bookmark'></i>
                    <span class="link_name">Livros</span>
                </a>
            </li>
            <li>
                <a href="usuarios/usuarios.php">
                    <i class='bx bx-book-content'></i>
                    <span class="link_name">Usuarios</span>
                </a>
            </li>
            <li class="sair">
                <a href="logout.php"><i class='bx bx-log-out'></i></a>
            </li>
        </ul>
    </nav>

    <!--começo do corpo da página-->
    <main>

        <div class="titulo">
            <h3>Olá, <?php echo $_SESSION['nome']; ?>, <br> Seja bem-vindo!</h3>
        </div>
        <div class="avaliar">
           <div class="textnotificaçao"> AVALIAR</div>


            <?php
            $sql = "SELECT resenha_titulo, res_nome_fantasia, resenha_id, livro_foto FROM RESENHAS INNER JOIN RESENHISTAS ON resenhistas.res_id = resenhas.res_id INNER JOIN LIVROS ON resenhas.livro_id = livroS.livro_id WHERE resenha_status = 0";

            if ($result = mysqli_query($conn, $sql)) {
                while ($resposta = mysqli_fetch_array($result)) {
                    echo "
                    <div class='card'>
                        <div class='imagem'>
                            <img class='imglivro' src='../administrador/imagens/livros/{$resposta['livro_foto']}' alt=''>
                        </div>
                        <div class='info'>
                            <p>{$resposta['resenha_titulo']}</p>
                            <p>- {$resposta['res_nome_fantasia']}</p>
                        </div>
                        <div class='acao'>
                           <a href='avaliar/avaliar.php?id={$resposta['resenha_id']}'>
                              <button class='botao'>Avaliar</button>
                           </a>
                        </div>
                    </div>             
                    ";
                }
            }

            $select = "SELECT usu_id, usu_email, usu_nome, liv_nome,liv_cidade,liv_estado,liv_endereco,liv_telefone,liv_email,liv_foto,liv_perfil,liv_social FROM usuarios INNER JOIN livrarias ON livrarias.liv_id = usuarios.usu_id WHERE usu_tipo_usuario = 1 AND usu_status = 0";

            if ($resultado = mysqli_query($conn, $select)) {
                while ($res = mysqli_fetch_array($resultado)) {
                    echo "
                    <div class='card'>
                        <div class='imagem'>
                            <img class='imglivro' src='../administrador/imagens/livrarias/{$res['liv_foto']}' alt=''>
                        </div>
                        <div class='info'>
                            <p>{$res['liv_nome']}</p>
                            <p>- {$res['usu_nome']}</p>
                        </div>
                        <div class='acao'>
                           <a href='avaliar/avaliar-livraria.php?id={$res['usu_id']}'>
                              <button class='botao'>Avaliar</button>
                           </a>
                        </div>
                    </div>             
                    ";
                }
            }

            ?>
        </div>


    </main>

    <script src="script.js"></script>

</body>

</html>