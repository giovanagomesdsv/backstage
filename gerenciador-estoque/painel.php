<?php 
include "conexao.php";

session_start();

if (!isset($_SESSION['cnpj'])) {
    header("Location: login.php");
    exit;
}

$cnpj = $_SESSION['cnpj'];
$nome = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Gerenciador BC</title>
</head>
<body>
    <h1>Seja bem-vindo, <?php echo htmlspecialchars($nome); ?>!!!</h1>

    <header>
        <a href="#">Home</a>
        <a href="cadastro de livros/cadastro-livros.php">Cadastro de livros</a>
        <a href="vendas/vendas.php">Vendas</a>
        <a href="estoque/estoque.php">Estoque</a>
        <a href="sair.php"><i class='bx bx-log-out'></i></a>
    </header>

    <?php



$dataAtual = date('Y-m-d');

// vendas de hoje
$sql = "SELECT COUNT(*) AS total_vendas FROM venda WHERE DATE(data_venda) = ? AND cnpj = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $dataAtual, $cnpj);
$stmt->execute();
$result = $stmt->get_result();
$dados = $result->fetch_assoc();
$totalVendas = $dados['total_vendas'] ?? 0;

// total de itens vendidos hoje e o valor total
$itens_dia = "SELECT SUM(quantidade) AS total_itens, SUM(total) AS valor_total FROM venda WHERE DATE(data_venda) = ? AND cnpj = ?";
$execucao = $conn->prepare($itens_dia);
$execucao->bind_param("ss", $dataAtual, $cnpj);
$execucao->execute();
$resultado = $execucao->get_result();
$total = $resultado->fetch_assoc();

$totalItens = $total['total_itens'] ?? 0; 
$valorTotal = $total['valor_total'] ?? 0; 

// Exibe 
echo "Número total de vendas realizadas hoje: $totalVendas<br>";
echo "Número total de itens vendidos hoje: $totalItens<br>";
echo "Valor total das vendas hoje: R$ " . number_format($valorTotal, 2, ',', '.');



/*-------------------------------------------------------------*/



$dataInicioMes = date('Y-m-01'); // Primeiro dia do mês
$dataFimMes = date('Y-m-t'); // Último dia do mês

// Vendas do mês atual
$sql = "SELECT COUNT(*) AS total_vendas FROM venda WHERE DATE(data_venda) BETWEEN ? AND ? AND cnpj = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $dataInicioMes, $dataFimMes, $cnpj);
$stmt->execute();
$result = $stmt->get_result();
$dados = $result->fetch_assoc();
$totalVendas = $dados['total_vendas'] ?? 0;

// Total de itens vendidos e valor total do mês
$itens_mes = "SELECT SUM(quantidade) AS total_itens, SUM(total) AS valor_total FROM venda WHERE DATE(data_venda) BETWEEN ? AND ? AND cnpj = ?";
$execucao = $conn->prepare($itens_mes);
$execucao->bind_param("sss", $dataInicioMes, $dataFimMes, $cnpj);
$execucao->execute();
$resultado = $execucao->get_result();
$total = $resultado->fetch_assoc();

$totalItens = $total['total_itens'] ?? 0; 
$valorTotal = $total['valor_total'] ?? 0; 

// Exibe os resultados
echo "<br>Número total de vendas realizadas neste mês: $totalVendas<br>";
echo "Número total de itens vendidos neste mês: $totalItens<br>";
echo "Valor total das vendas neste mês: R$ " . number_format($valorTotal, 2, ',', '.');

$stmt->close();
$execucao->close();

?>

        

</body>
</html>
