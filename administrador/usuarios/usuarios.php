
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


    <link rel="stylesheet" href="usuario.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>ADM BC - Usuarios</title>
</head>

<body style="background-color:#DEDEDE">
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
            <li>
                <a href="../livro/livros.php">
                    <i class='bx bx-book-bookmark'></i>
                    <span class="link_name">Livros</span>
                </a>
            </li>
            <li class="fix">
                <a href="usuarios.php">
                    <i class='bx bx-book-content'></i>
                    <span class="link_name">Usuarios</span>
                </a>
            </li>
            <li class="sair">
                <a href="../logout.php"><i class='bx bx-log-out'></i></a>
            </li>
        </ul>
    </nav>
    
    <main>
<!--Botão de cadastro de usuário-->
<div class='container'>
    <div class="botao">
        <a href="cadastrarusuario.php">Cadastrar usuário</a>
    </div>

    <!-- BARRA DE PESQUISA -->
    <div class="busca">
        <form action="" method="GET" class="search-form">
            <input type="text" name="busca" placeholder="PESQUISAR USUARIOS" class="search-input">
        </form>
    </div>
</div>
        <div> <!-- DIV DA CAIXA ONDE DENTRO APARECERÁ OS CARDS DO RESULTADO DA BUSCA-->
            <?php
            if (!isset($_GET['busca']) || empty($_GET['busca'])) {
                echo "<div class='resultados'></div>";
            } else {

                // Proteção contra SQL Injection
                $pesquisa = $conn->real_escape_string($_GET['busca']);

                // Query de busca
                $sql_code = "SELECT usu_nome, usu_id FROM usuarios WHERE usu_nome LIKE '%$pesquisa%' ";
                $sql_query = $conn->query($sql_code) or die("Erro ao consultar: " . $conn->error);

                if ($sql_query->num_rows == 0) {
                    echo "<div class='resultados'><h3>Nenhum resultado encontrado!</h3></div>";
                } else {
                    while ($dados = $sql_query->fetch_assoc()) {
                        echo "
                
                        <div class='containerInput'>
                        <text>NOME DE USUARIO</text>
                         <p class='inputNome'>Usuário: {$dados['usu_nome']}</p>
                         <text>ID</text>
                        <div class='containerBtnInput'>
                         <p class='inputID'>Id: {$dados['usu_id']}</p>
                          <a href='editarusuario.php?id={$dados['usu_id']}'><div class='botao'>ATUALIZAR</div></a>
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
              $consulta = "SELECT usu_nome, usu_id, usu_status FROM usuarios order by usu_data_criacao desc";  

              if ($card = mysqli_query($conn, $consulta)) {
                while ($row = mysqli_fetch_array($card)) {

                    if ($row['usu_status'] == 0) {
                        echo "
                        <div class='containerInput-des'>
                            <text>NOME DE USUARIO</text>
                             <p class='inputNome'>Usuário: {$row['usu_nome']}</p>
                             <text>ID</text>
                            <div class='containerBtnInput'>
                             <p class='inputID'>Id: {$row['usu_id']}</p>
                              <a href='editarusuario.php?id={$row['usu_id']}'><div class='botao'>ATUALIZAR</div></a>
                            </div>
                           </div>
                           "; 
                        }  else {
                  
                   echo " <div class='containerInput'>
                        <text>NOME DE USUARIO</text>
                         <p class='inputNome'>Usuário: {$row['usu_nome']}</p>
                         <text>ID</text>
                        <div class='containerBtnInput'>
                         <p class='inputID'>Id: {$row['usu_id']}</p>
                          <a href='editarusuario.php?id={$row['usu_id']}'><div class='botao'>ATUALIZAR</div></a>
                        </div>
                       </div>
                    ";
                }
            }
      }

            
              
            ?>
        </div>

        


    </main>
   
    <script src="../script.js"></script>
</body>

</html>