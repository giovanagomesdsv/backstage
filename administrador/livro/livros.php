<?php
include "../conexao-banco/conexao.php";
include "../protecao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="../geral.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>ADM BC - Livros</title>
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
            <li >
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
            <li>
                <a href="../resenhistas/resenhistas.php">
                    <i class='bx bx-user-pin'></i>
                    <span class="link_name">Resenhistas</span>
                </a>
            </li>
            <li class="fix">
                <a href="livros.php">
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
    </nav> -->
   
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
    livros.livro_titulo, 
    livros.livro_foto, 
    livrarias_livros.liv_livro_preco, 
    autores.aut_nome, 
    livrarias.liv_nome
FROM livros
INNER JOIN livrarias_livros ON livros.livro_id = livrarias_livros.livro_id
INNER JOIN livrarias ON livrarias_livros.liv_id = livrarias.liv_id
INNER JOIN livro_autores ON livros.livro_id = livro_autores.livro_id
INNER JOIN autores ON livro_autores.aut_id = autores.aut_id
   WHERE livro_titulo LIKE '%$pesquisa%' AND liv_livro_status = '1'";
    // PAREI AQUI
                $sql_query = $conn->query($sql_code) or die("Erro ao consultar: " . $conn->error);

                if ($sql_query->num_rows == 0) {
                    echo "<div class='resultados'><h3>Nenhum resultado encontrado!</h3></div>";
                } else {

                    while ($dados = $sql_query->fetch_assoc()) {
                         echo "
                         <div>
        <div>
           <img src='../imagens/livros/{$dados['livro_foto']}'>
        </div>
        <div>
           <p>{$dados['livro_titulo']}</p>
           <p>{$dados['aut_nome']}</p>
           <p>R$ {$dados['liv_livro_preco']}</p>
           <p>{$dados['liv_nome']}</p>
        </div>
    </div>
         
            ";
                    }

                }
            }
            ?>
        </div>




    <div>
        <?php
        $consulta = "
        SELECT 
    livros.livro_titulo, 
    livros.livro_foto, 
    livrarias_livros.liv_livro_preco, 
    autores.aut_nome, 
    livrarias.liv_nome
FROM livros
INNER JOIN livrarias_livros ON livros.livro_id = livrarias_livros.livro_id
INNER JOIN livrarias ON livrarias_livros.liv_id = livrarias.liv_id
INNER JOIN livro_autores ON livros.livro_id = livro_autores.livro_id
INNER JOIN autores ON livro_autores.aut_id = autores.aut_id
        ";

        if ($tabela = mysqli_query($conn, $consulta)) {
           
            while ($linha = mysqli_fetch_array($tabela)) {
                echo "
    <div>
        <div>
           <img src='../imagens/livros/{$linha['livro_foto']}'>
        </div>
        <div>
           <p>{$linha['livro_titulo']}</p>
           <p>{$linha['aut_nome']}</p>
           <p>{$linha['liv_livro_preco']}</p>
           <p>{$linha['liv_nome']}</p>
        </div>
    </div>

                ";
            }

            
        }

        ?>
    </div>
   
   


    <script src="../script.js"></script>
</body>

</html>