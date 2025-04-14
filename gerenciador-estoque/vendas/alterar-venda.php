<?php 
include "../conexao.php";

$dado = $_GET['id'];

$itens = isset($_POST['itens']) ? $_POST['itens'] : null;
$quant = isset($_POST['quant']) ? $_POST['quant'] : null;
$forma_pagamento = isset($_POST['forma_pagamento']) ? $_POST['forma_pagamento'] : null;
$especificacao_venda = isset($_POST['especificacao_venda']) ? $_POST['especificacao_venda'] : null;
$valor = isset($_POST['valor']) ? $_POST['valor'] : null;

$update = "UPDATE venda SET itens = '$itens', quantidade = '$quant', forma_pagamento = '$forma_pagamento',  especificacao_venda = '$especificacao_venda', total = '$valor' WHERE id_venda = '$dado'";


if($resultado = mysqli_query($conn, $update)) {
    echo "<script>alert('Venda atualizada com sucesso!'); 
    location.href = 'vendas.php'; 
      </script>
";
} else {
echo "<script>alert('Erro ao atualizar os dados!'); 
    location.href = 'vendas.php'; 
      </script>
";
}
?>