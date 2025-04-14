<?php 
include "../conexao.php";
session_start();

$cnpj =  $_SESSION['cnpj'];

$itens = isset($_POST['itens']) ? $_POST['itens'] : null;
$quant = isset($_POST['quant']) ? $_POST['quant'] : null;
$forma_pagamento = isset($_POST['forma_pagamento']) ? $_POST['forma_pagamento'] : null;
$especificacao_venda = isset($_POST['especificacao_venda']) ? $_POST['especificacao_venda'] : null;
$valor = isset($_POST['valor']) ? $_POST['valor'] : null;


$insert = "INSERT INTO venda (cnpj, itens , quantidade, total, forma_pagamento, especificacao_venda) VALUES ('$cnpj', '$itens ', '$quant', '$valor', '$forma_pagamento', '$especificacao_venda')";

if($resultado = mysqli_query($conn, $insert)) {
    echo "<script>alert('Venda cadastrada com sucesso! ATUALIZE IMEDIATAMENTE O ESTOQUE!!!!'); 
    location.href = 'vendas.php'; 
      </script>
";
} else {
echo "<script>alert('Erro ao inserir os dados!'); 
    location.href = 'vendas.php'; 
      </script>
";
}
?>