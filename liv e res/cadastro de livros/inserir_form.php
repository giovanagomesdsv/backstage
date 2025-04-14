<?php
include "../conexao.php";

session_start();

if (!isset($_SESSION['cnpj'])) {
    echo "
      <script>
         alert('Você precisa estar logado para operar como uma livraria!');
         location.href = 'login.php';
      </script>
    ";
    exit;
}

$cnpj = $_SESSION['cnpj'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura e valida os dados do formulário
    $livro = isset($_POST['livro']) ? trim($_POST['livro']) : '';
    $autor = isset($_POST['autor']) ? trim($_POST['autor']) : '';
    $slug = isset($_POST['slug']) ? trim($_POST['slug']) : '';
    $isbn = isset($_POST['isbn']) ? trim($_POST['isbn']) : '';
    $ano = isset($_POST['ano_publi']) ? trim($_POST['ano_publi']) : '';
    $editora = isset($_POST['editora']) ? trim($_POST['editora']) : '';
    $dimensoes = isset($_POST['dimensoes']) ? trim($_POST['dimensoes']) : '';
    $idioma = isset($_POST['idioma']) ? trim($_POST['idioma']) : '';
    $pag = isset($_POST['pag']) ? trim($_POST['pag']) : '';
    $tipo = isset($_POST['tipo']) ? trim($_POST['tipo']) : '';
    $idade = isset($_POST['classificacao_idade']) ? trim($_POST['classificacao_idade']) : '';
    $genero = isset($_POST['genero']) ? trim($_POST['genero']) : '';
    $sinopse = isset($_POST['sinopse']) ? trim($_POST['sinopse']) : '';
    $especifi_livro = isset($_POST['especifi_livro']) ? trim($_POST['especifi_livro']) : '';
    $preco = isset($_POST['preco']) ? trim($_POST['preco']) : '';
    $estoque = isset($_POST['estoque']) ? trim($_POST['estoque']) : '';
    $forma_obt = isset($_POST['forma_obt']) ? implode(', ', $_POST['forma_obt']) : '';
    $forma_pag = isset($_POST['forma_pag']) ? implode(', ', $_POST['forma_pag']) : '';

    
    if (empty($livro) || empty($autor) || empty($forma_obt) || empty($forma_pag)) {
        echo "<script>alert('Todos os campos são obrigatórios!'); window.history.back();
        </script>";
        exit;
    }

    // Verifica se o autor existe
    $sql_autor = "SELECT id_escritor FROM escritor WHERE LOWER(nome) = LOWER(?)";
    $stmt_autor = $conn->prepare($sql_autor);

        /* O método bind_param() é usado para vincular os parâmetros da consulta SQL com as variáveis PHP. O primeiro parâmetro indica o tipo de dado da variável que será vinculada:

"s" significa que o parâmetro que estamos passando (neste caso, $autor) é uma string. */

    $stmt_autor->bind_param("s", $autor);
    $stmt_autor->execute();
    // pega o resultado encontrado
    $result_autor = $stmt_autor->get_result();
    // Esse método retorna a próxima linha do conjunto de resultados como um array associativo. Cada coluna no resultado será acessada pelo nome do campo (por exemplo, id_escritor).
    $autor_linha = $result_autor->fetch_assoc();

    if ($autor_linha) {
        $id_escritor = $autor_linha['id_escritor'];
    } else {
        echo "<script>alert('Autor não encontrado no banco de dados! Envie uma formulário para o administrador e espere a confirmação por e-mail'); 
        location.href = 'form-autor-nao-encontrado.php';
        </script>";
        exit;
    }

    if (isset($_FILES['arquivo'])) {
        $arquivo = $_FILES['arquivo'];
    
        if ($arquivo['error'])
            die("Falha ao enviar arquivo");
    
        if ($arquivo['size'] > 2097152) 
            die("Arquivo muito grande! Max: 2MB");
    
    
            $nomeDoArquivo = $arquivo['name'];
            $novoNomeDoArquivo = uniqid();
            $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
            $pasta = "img-livro/";
    
        if($extensao != "jpg" && $extensao != 'png')
           die("Tipo de arquivo não aceito!");
    
           $path = $novoNomeDoArquivo . "." . $extensao;
    
           $caminho = $pasta . $novoNomeDoArquivo . "." . $extensao;
    
           $deu_certo = move_uploaded_file($arquivo["tmp_name"], $caminho);
    }

    // Insere os dados do livro
    $sql = "INSERT INTO livro (cnpj, id_escritor, slug, titulo,path, isbn,ano, editora, dimensoes, idioma, paginas, tipo, classificacao_idade, genero, sinopse, especificacao_livro, preco, forma_pagamento, forma_obt, estoque
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ssssssisssissssssssi', $cnpj, $id_escritor, $slug, $livro, $path, $isbn, $ano,  $editora, $dimensoes, $idioma, $pag, $tipo, $idade, $genero, $sinopse, $especifi_livro, $preco,  $forma_pag, $forma_obt, $estoque);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "
              <script>
                  alert('Dados inseridos com sucesso!');
                  location.href = 'cadastro-livros.php';
              </script>
            ";
        } else {
            echo "<script>alert('Erro ao inserir os dados!'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "Erro ao preparar a declaração: " . $conn->error;
    }
}

$conn->close();
?>
