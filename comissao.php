<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');

$soma = 0;
$comissao = 0;

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Comissão </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>
    <script>
        
        /*
        document.getElementById('cod').value vira simplesmente $("#cod").val()
        */

        function obterDadosModal(valor) {

            var retorno = valor.split("*");

            document.getElementById('cod').value   = retorno[0];
            document.getElementById('nome').value  = retorno[1];
        }

    </script>

    <div class="container">
        <div class="row">

            <h2>Controle comissão dos funcionários: </h2><br>
            <form action="comissao.php" method="POST">
                <input type="text" name="nome" placeholder="Nome Funcionario..." class="span4" style="margin-bottom: -2px; height: 25px;">
                <button type="submit" name="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
                
               
            </form>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Total Venda R$</b></td>
                    <td><b>Comissão 10%</b></td>
                </tr>
                  <?php

                if (isset($_POST['pesquisar']))
                {
                   $nome   = strtoupper($_POST['nome']);    // converter maiuscula

                   $consulta = "select funcionarios.cod, funcionarios.nome, (pedidos.quantidade * pedidos.preco) as total
                                from pedidos, funcionarios
                                where funcionarios.cod = pedidos.codfunc
                                and UPPER(funcionarios.nome) like '%$nome%'";

                   $resultado = mysql_query($consulta);
                }
                else
                {
                    $consulta = "select funcionarios.cod, funcionarios.nome, (pedidos.quantidade * pedidos.preco) as total
                                 from pedidos, funcionarios
                                 where funcionarios.cod = pedidos.codfunc";
                    $resultado = mysql_query($consulta);
                }

                while ($dados = mysql_fetch_array($resultado))
                {
                    $strdados = $dados['cod'] . "*" .  $dados['nome'] . "*" . $dados['total'];
                    $soma = $soma + $dados['total'];
                    $comissao = $comissao + $dados['total'] * '0.1';
                ?>
                    <tr>
                        <td><?php echo $dados['cod']; ?></td>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['total']; ?></td>
                        <td><?php echo $dados['total'] * '0.1'; ?></td>
                    </tr>
                <?php
                }
                mysql_close($conectar);
                ?>
            </table>
            <table border="0px">       
                <tr>
                    <td width=375px> </td>
                    <td width=400px><?php echo "TOTAL R$ ".$soma;?></td>
                    <td><?php echo "TOTAL R$ ".$comissao;?></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- Biblioteca requerida -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
