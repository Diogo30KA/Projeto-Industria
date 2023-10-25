<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');

//------- pesquisa funcionarios
$sql_funcionarios = "SELECT cod,nome FROM funcionarios";
$res_funcionarios = mysql_query($sql_funcionarios);

//------- pesquisa clientes
$sql_clientes = "SELECT cod,nome FROM clientes";
$res_clientes = mysql_query($sql_clientes);

//------- pesquisa produtos
$sql_produtos = "SELECT cod,nome FROM produtos";
$res_produtos = mysql_query($sql_produtos);

$soma = 0;

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Pesquisa controle financeiro </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>
    <script>
        
        /*
        document.getElementById('cod').value vira simplesmente $("#cod").val()
        */

        function obterDadosModal(valor) {

            var retorno = valor.split("*");

            document.getElementById('cod').value        = retorno[0];
            document.getElementById('datapedido').value = retorno[1];
            document.getElementById('codfunc').value    = retorno[2];
            document.getElementById('codcli').value     = retorno[3];
            
        }

    </script>

    <div class="container">
        <div class="row">

            <h2>Controle Financeiro - Pedidos de Vendas </h2><br>
            <form action="financeiro.php" method="POST">
                Período:ㅤㅤ<input type="date" name="datainicial" id="datainicial" placeholder="Data inicial..." class="span4" style="margin-bottom: -2px; height: 25px;"> 
                <input type="date" name="datafinal" id="datafinal" placeholder="Data final..." class="span4" style="margin-bottom: -2px; height: 25px;"><br><br>
                Funcionário: <input type="text" name="codfunc" id="codfunc" placeholder="Cod func..." size=10 class="span4" style="margin-bottom: -2px; height: 25px;"><br><br>
                Cliente: ㅤㅤ<input type="text" name="codfunc" id="codfunc" placeholder="Cod cliente..." size=10 class="span4" style="margin-bottom: -2px; height: 25px;">ㅤㅤ
                <button type="submit" name="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
                
            </form>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Data</b></td>
                    <td><b>Funcionario</b></td>
                    <td><b>Cliente</b></td>
                    <td><b>Total pedido R$</b></td>
                </tr>
                <?php
                if (isset($_POST['pesquisar']))
                {
                   $codfunc    = $_POST['codfunc'];
                   $datainicial = $_POST['datainicial'];
                   $datafinal = $_POST['datafinal'];

                   $consulta = "select cod,datapedido,codfunc,codcli,(pedidos.quantidade * pedidos.preco) as total
                                from pedidos
                                where codfunc = '$codfunc' or 
                                datapedido >= '$datainicial' and datapedido <= '$datafinal'";
                   $resultado = mysql_query($consulta);
                }
                else
                {
                    $consulta = "select pedidos.cod,pedidos.datapedido,funcionarios.nome codfunc,clientes.nome codcli,
                                 (pedidos.quantidade * pedidos.preco) as total
                                 from pedidos, funcionarios, clientes, produtos
                                 where pedidos.codfunc = funcionarios.cod
                                 and pedidos.codcli = clientes.cod
                                 and pedidos.codprod = produtos.cod
                                 order by cod";
                     $resultado = mysql_query($consulta);
                }

                while ($dados = mysql_fetch_array($resultado))
                {
                    $strdados = $dados['cod'] . "*" .  $dados['datapedido'] . "*" . $dados['codfunc'] . "*" . $dados['codcli'];
                    $soma = $soma + $dados['total'];
                ?>
                    <tr>
                        <td><?php echo $dados['cod']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($dados['datapedido'])); ?></td>
                        <td><?php echo $dados['codfunc']; ?></td>
                        <td><?php echo $dados['codcli']; ?></td>
                        <td><?php echo $dados['total']; ?></td>
                    </tr>
                <?php
                }
                mysql_close($conectar);
                ?>
            </table>
            <table border="0px">       
                <tr>
                    <td width=910px></td>
                    <td width=100px><?php echo "TOTAL R$ "?></td>
                    <td width=400px><?php echo $soma;?></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- Biblioteca requerida -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
