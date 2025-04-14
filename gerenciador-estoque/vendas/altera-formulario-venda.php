<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar venda</title>
</head>
<body>
    <?php 
    include "../conexao.php";
    $dado = $_GET['id'];

    $select = "SELECT * FROM venda WHERE id_venda = '$dado'";

    if ($resultado = mysqli_query($conn, $select)) {
        while ($venda = mysqli_fetch_array($resultado)) {
            echo "
            <form action='alterar-venda.php?id={$dado}' method='POST'>

             <label for='itens'>Itens:</label>
        <input type='text' name='itens' value='{$venda['itens']}' required>

        <label for='quant'>Quantidade total:</label>
        <input type='number' name='quant' value='{$venda['quantidade']}' required>

        <label for='valor'>Valor total:</label>
        <input type='number' step='0.01' name='valor' value='{$venda['quantidade']}' required>

        <label for='forma_pagamento'>Forma de pagamento:</label>
        <select name='forma_pagamento' required>
            <option value=''>{$venda['forma_pagamento']}</option>
            <option value='dinheiro'>Dinheiro</option>
            <option value='cartao_debito'>cartão débito</option>
            <option value='cartao_credito'>cartao crédito</option>
            <option value='boleto'>boleto</option>
            <option value='pix'>pix</option>
        </select>

        <label for='especificacao_venda'>Especificação de venda:</label>
        <select name='especificacao_venda' required>
            <option value=''>{$venda['especificacao_venda']}</option>
            <option value='Venda Online'>Venda Online</option>
            <option value='Loja'>Loja</option>
            <option value='Site BC'>Site BC</option>
        </select>

        <input type='submit' value='Enviar'>
            </form>
            ";
        }
    }
    ?>
</body>
</html>