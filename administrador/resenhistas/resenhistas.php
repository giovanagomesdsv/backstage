<?php
include "../conexao-banco/conexao.php";

include "../protecao.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../geral.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>ADM BC - Resenhistas</title>
</head>

<body>
    <header>
        Administrador BC
    </header>
    <!--
    <nav class="sidebar" id="sidebar">
        <div class="nome">
            <div class="logo_name">Bem Vindo, <br> <?php echo $_SESSION['nome']; ?>!</div>
            <div class="menu" id="menu">
                <i class="bx bx-menu"></i>
            </div>
        </div>
        <ul class="nav-list">
            <li>
                <a href="../home.php">
                    <i class='bx bx-home-alt-2'></i>
                    <span class="link_name">Home</span>
                </a>
            </li>
            <li>
                <a href="../livrarias/livrarias.php">
                    <i class='bx bx-user'></i>
                    <span class="link_name">Livrarias</span>
                </a>
            </li>
            <li class="fix">
                <a href="resenhistas.php">
                    <i class='bx bx-user-pin'></i>
                    <span class="link_name">Resenhistas</span>
                </a>
            </li>
            <li>
                <a href="../livro/livros.php">
                    <i class='bx bx-book-bookmark'></i>
                    <span class="link_name">Livros</span>
                </a>
            </li>
            <li>
                <a href="../usuarios/usuarios.php">
                    <i class='bx bx-book-content'></i>
                    <span class="link_name">Usuarios</span>
                </a>
            </li>
            <li class="sair">
                <a href="../logout.php"><i class='bx bx-log-out'></i></a>
            </li>
        </ul>
    </nav>
-->
    <div>
        <a href="cadastrarresenhista.php">Cadastrar resenhista</a>
    </div>
    <div>

    
<!--EXIBE OS CARDS DAS LIVRARIAS-->
<div class="busca">
            <form action="" method="GET">
                <input type="text" name="busca" placeholder="Busque os resenhistas...">
                <button type="submit">Pesquisar</button>
            </form>
        </div>

       
        <div class="pesquisa">
            <?php
            if (!isset($_GET['busca']) || empty($_GET['busca'])) {
                echo "<div class='resultados'></div>";
            } else {

                // Proteção contra SQL Injection
                $pesquisa = $conn->real_escape_string($_GET['busca']);

                // Query de busca
                $sql_code = "SELECT 
    resenhistas.res_nome_fantasia,
    resenhistas.res_telefone,
    titulo.tit_nome,
    resenhistas.res_foto,
    usuarios.usu_nome,
    COUNT(resenhas.res_id) AS total_resenhas
FROM 
    resenhistas
LEFT JOIN 
    resenhas ON resenhistas.res_id = resenhas.res_id
LEFT JOIN 
    titulo ON resenhistas.tit_id = titulo.tit_id
LEFT JOIN usuarios ON  usuarios.usu_id = resenhistas.res_id
GROUP BY 
    usuarios.usu_nome,
    resenhistas.res_id,
    resenhistas.res_nome_fantasia,
    resenhistas.res_telefone,
    titulo.tit_nome,
    resenhistas.res_foto
";
                   $sql_query = $conn->query($sql_code) or die("Erro ao consultar: " . $conn->error);

                if ($sql_query->num_rows == 0) {
                    echo "<div class='resultados'><h3>Nenhum resultado encontrado!</h3></div>";
                } else {

                    while ($dados = $sql_query->fetch_assoc()) {
                         echo "
            <div>
                <div>
                    <a href=\"https://wa.me/{$dados['res_telefone']}?text=$mensagem\" target=\"_blank\"><img src='../imagens/resenhistas/{$dados['res_foto']}' alt='Foto do Resenhista'></a>
                    <h3>{$dados['usu_nome']}</h3>
                    <p><strong>Pseudônimo:</strong> {$dados['res_nome_fantasia']}</p>
                    <p><strong>Titulo:</strong> {$dados['tit_nome']}</p>
                </div>
                <div>
                    <p><strong>Total de Resenhas:</strong> {$dados['total_resenhas']}</p>
                </div>
            </div>
            ";
                    }

                }
            }
            ?>
        </div>


        <?php
        // Consulta que obtém informações dos resenhistas e total de resenhas
        $consulta = " SELECT 
            resenhistas.res_nome_fantasia,
    resenhistas.res_telefone,
    titulo.tit_nome,
    resenhistas.res_foto,
    usuarios.usu_nome,
    COUNT(resenhas.res_id) AS total_resenhas
FROM 
    resenhistas
LEFT JOIN 
    resenhas ON resenhistas.res_id = resenhas.res_id
LEFT JOIN 
    titulo ON resenhistas.tit_id = titulo.tit_id
LEFT JOIN usuarios ON  usuarios.usu_id = resenhistas.res_id
GROUP BY 
    usuarios.usu_nome,
    resenhistas.res_id,
    resenhistas.res_nome_fantasia,
    resenhistas.res_telefone,
    titulo.tit_nome,
    resenhistas.res_foto
        ";

        if ($resp_consulta = mysqli_query($conn, $consulta)) {

            while ($linha = mysqli_fetch_array($resp_consulta)) {
                $mensagem = urlencode("Olá, aqui fala a admistradora do site Bibliófilos community!");

                echo "
            <div>
                <div>
                    <a href=\"https://wa.me/{$linha['res_telefone']}?text=$mensagem\" target=\"_blank\"><img src='../imagens/resenhistas/{$linha['res_foto']}' alt='Foto do Resenhista'></a>
                     <h3>{$linha['usu_nome']}</h3>
                    <p><strong>Pseudônimo:</strong> {$linha['res_nome_fantasia']}</p>
                    <p><strong>Titulo:</strong> {$linha['tit_nome']}</p>
                </div>
                <div>
                    <p><strong>Total de Resenhas:</strong> {$linha['total_resenhas']}</p>
                </div>
            </div>
            ";
            }
        } else {
            echo "<p>Erro ao executar a consulta: " . mysqli_error($conn) . "</p>";
        }
        ?>

    </div>
    <script src="../script.js"></script>
</body>

</html>