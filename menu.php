<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Menu </title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
    <div id="superior">
        <b>SISTEMA DE VENDAS</b>
    </div>
    <br><br><br>
      <div class="modal-body">
            <center><table width=850 border=0>
            <form class="form-group-well" action="menu.php" method="POST">
                <tr>
                    <td>
                    <a href="funcionarios.php">
                    <input type="button" name="cadastrarfunc" id="cadastrarfunc" value="Funcionarios"
                    class="btn"></button></a>
                    </td>
                    <td>
                    <a href="pedidos.php">
                    <input type="button" name="cadastrarped" id="cadastrarped" value="Pedidos"
                    class="btn"></button></a>
                    </td>
                    <td>
                    <a href="financeiro.php">
                    <input type="button" name="faturamento" id="faturamento" value="Faturamento"
                    class="btn2"></button></a>
                    </td>
                 </tr>
                <tr>
                    <td>
                    <a href="clientes.php">
                    <input type="button" name="cadastrarcli" id="cadastrarcli" value="Clientes"
                    class="btn"></button></a>
                    </td>
                    <td>
                    <a href="estoque.php">
                    <input type="button" name="estoque" id="estoque" value="Estoque"
                    class="btn"></button></a>
                    </td>
                    <td>
                    <a href="comissao.php">
                    <input type="button" name="comissao" id="comissao" value="Comissao"
                    class="btn2"></button></a>
                    </td>
                 </tr>
                 <tr>
                    <td>
                    <a href="produtos.php">
                    <input type="button" name="cadastrarprod" id="cadastrarprod" value="Produtos"
                    class="btn"></button></a>
                    </td>
                 </tr>
            </table>
            </form>
        </div>
    
</body>

</html>

