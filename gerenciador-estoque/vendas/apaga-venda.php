<?php 
include "../conexao.php";

$dado = $_GET['id'];

$exclusao = "DELETE FROM venda WHERE id_venda = '$dado'";

if ($resp = mysqli_query($conn, $exclusao)) {
     echo "
     <script>
     alert('Venda excluida do sistema!');
     location.href = 'vendas.php'
     </script>;
     ";
} else {
    echo "
    <script>
    alert('Erro ao excluir!');
    location.href = 'vendas.php'
    </script>;
    ";
}
?>