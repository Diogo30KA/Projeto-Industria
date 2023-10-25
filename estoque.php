<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');

$soma = 0;

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Estoque </title>
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
            document.getElementById('quantidade').value = retorno[2];
        }

    </script>
    
    <div class="container">
        <div class="row">

            <h2>Pesquisa Estoque: </h2><br>
            <form action="estoque.php" method="POST">
                <input type="text" name="nome" placeholder="Nome Produto..." class="span4" style="margin-bottom: -2px; height: 25px;">
                <button type="submit" name="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
                <a href="#myModalCadastrar">
            <br><br>
            </form>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Qtde do estoque</b></td>
                    <td><b>Qtde mínima estoque</b></td>
                    <td><b>SALDO</b></td>
                </tr>
                  <?php
                  

                if (isset($_POST['pesquisar']))
                {
                   $nome   = strtoupper($_POST['nome']);    // converter maiuscula

                   $consulta = "select cod,nome,quantidade from produtos
                                where UPPER(nome) like '%$nome%'";

                   $resultado = mysql_query($consulta);
                }
                else
                {
                    $consulta = "select cod,nome,quantidade,preco from produtos";
                    $resultado = mysql_query($consulta);
                }

                while ($dados = mysql_fetch_array($resultado))
                {
                    $strdados = $dados['cod'] . "*" .  $dados['nome'] . "*" . $dados['quantidade'];
                    $soma = $soma + $dados['quantidade'];
                ?>
                    <tr>
                        <td><?php echo $dados['cod']; ?></td>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['quantidade']; ?></td>
                        <td><?php echo '20'; ?></td>
                        <td><?php echo $dados['quantidade'] - '20'; ?></td>
                    </tr>
                <?php
                }
                mysql_close($conectar);
                ?>
            </table>
            <table border="0px">       
                <tr>
                    <td width=290px> </td>
                  
                    <td><?php echo "TOTAL ".$soma;?></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- Biblioteca requerida -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
