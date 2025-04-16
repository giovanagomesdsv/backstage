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

    <title>ADM BC - Livrarias</title>
</head>

<body>
    <header>
        Administrador BC
    </header>
 <!--   <nav class="sidebar" id="sidebar"> 
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
            <li class="fix">
                <a href="livrarias.php">
                    <i class='bx bx-user'></i>
                    <span class="link_name">Livrarias</span>
                </a>
            </li>
            <li>
                <a href="../resenhistas/resenhistas.php">
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
    </nav>-->

<!--EXIBE OS CARDS DAS LIVRARIAS-->
<div class="busca">
            <form action="" method="GET">
                <input type="text" name="busca" placeholder="Busque as livrarias...">
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
    liv_nome,liv_cidade,liv_estado,liv_endereco, liv_email,liv_foto, liv_telefone, livrarias.liv_id,
    COUNT(livrarias_livros.liv_livro_id) AS total_livros 
FROM 
    livrarias
LEFT JOIN 
    livrarias_livros
ON 
    livrarias.liv_id =  livrarias_livros.liv_id
   WHERE liv_nome LIKE '%$pesquisa%'";
    // PAREI AQUI
                $sql_query = $conn->query($sql_code) or die("Erro ao consultar: " . $conn->error);

                if ($sql_query->num_rows == 0) {
                    echo "<div class='resultados'><h3>Nenhum resultado encontrado!</h3></div>";
                } else {

                    while ($dados = $sql_query->fetch_assoc()) {
                         echo "
            <div>
                <a href=\"https://wa.me/{$dados['liv_telefone']}?text=$mensagem\" target=\"_blank\">
                  <img src=\"../imagens/livrarias/{$dados['liv_foto']}\" alt=\"Logo da livraria\">
                   
                </a>
                <p>{$dados['liv_nome']}</p>
                <p>{$dados['liv_email']}</p>
                <p>{$dados['liv_endereco']}. {$dados['liv_cidade']} ({$dados['liv_estado']})</p>
                <div>{$dados['total_livros']}</div>
            </div>
            ";
                    }

                }
            }
            ?>
        </div>

    <div>
        <?php
        $consulta = "SELECT 
    liv_nome,liv_cidade,liv_estado,liv_endereco, liv_email,liv_foto, liv_telefone, livrarias.liv_id,
    COUNT(livrarias_livros.liv_livro_id) AS total_livros 
FROM 
    livrarias
LEFT JOIN 
    livrarias_livros
ON 
    livrarias.liv_id =  livrarias_livros.liv_id
GROUP BY 
    liv_nome,liv_cidade,liv_estado,liv_endereco, liv_email,liv_foto

";

        if ($resp_consulta = mysqli_query($conn, $consulta)) {

            while ($registro = mysqli_fetch_array($resp_consulta)) {
                // Mensagem personalizada para o WhatsApp
                $mensagem = urlencode("Olá, aqui fala a admiistradora do site Bibliófilos community, gostaria de solicitar mais informações sobre sua livraria/ movimentações no nosso site!");

                echo "
            <div>
                <a href=\"https://wa.me/{$registro['liv_telefone']}?text=$mensagem\" target=\"_blank\">
                  <img src=\"../imagens/livrarias/{$registro['liv_foto']}\" alt=\"Logo da livraria\">
                   
                </a>
                <p>{$registro['liv_nome']}</p>
                <p>{$registro['liv_email']}</p>
                <p>{$registro['liv_endereco']}. {$registro['liv_cidade']} ({$registro['liv_estado']})</p>
                <div>{$registro['total_livros']}</div>
            </div>
            ";
            }
        }
        ?>
      
    </div>

    <script src="../script.js"></script>
</body>

</html>