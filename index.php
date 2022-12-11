<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ed Pizzas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-image: url('pizzaria.jpg') 
        }
        h2 {
            color: red;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-size: 40px;
        }
        h3{
            color: whitesmoke;
        }
        div {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: whitesmoke;
            padding: 5px;
            font-weight: bolder;
        }
        td{
            background-color: gray;
        }

    </style>
</head>

<body>
    <?php

    $pdo = new PDO("mysql:host=localhost;dbname=pizzaria", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['excluir'])) {
        $cod_cliente = (int) $_GET['excluir'];
        $pdo->exec("DELETE FROM tab_cadastro WHERE cod_cliente = $cod_cliente");
        echo "<h2>Cliente $cod_cliente foi excluído com sucesso!</h2>";
        //voltar para o index
        header("Location: index.php");
    }

    if (isset($_POST['nome'])) {
        $sql = $pdo->prepare("INSERT INTO `tab_cadastro` VALUES (null, ?, ?, ?, ?, ?)");
        $nome = $_POST['nome'];
        $sql->execute(array($nome, $_POST['endereco'], $_POST['tamanho'], $_POST['sabor1'], $_POST['sabor2']));
        echo "<h2>Cliente $nome cadastrado com sucesso!</h2>";
    }

    ?>

    <div class="container">
        <form method="POST" max-width="50%">
            <legend>
                <h2 class="row justify-content-center">Ed Pizzas</h2>
                <h3 class="row justify-content-center">Faça seu Pedido Aqui !</h3>
            </legend>

            <fieldset>
                <div>
                    Nome: <input type="text" name="nome" class="form-control">
                </div>
                <div>
                    Endereço: <input type="text" class="form-control" name="endereco">
                </div>
                <div>
                    Tamanho da Pizza: (GG, G, M, P) <input type="text" class="form-control" name="tamanho">
                </div>
                <div>
                    1° Sabor: <input type="text" class="form-control" name="sabor1">
                </div>
                <div>
                    2° Sabor: <input type="text" class="form-control" name="sabor2">
                </div>
                <div>
                    <input type="submit" class="btn btn-success" value="Enviar">

                    <input type="reset" class="btn btn-warning" value="Limpar Dados">
                </div>
        </form>
        </fieldset>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <br>
    <?php
    $sql = $pdo->prepare("SELECT * FROM `tab_cadastro`");
    $sql->execute();
    $clientes = $sql->fetchAll(); //array associativo com tudo da tabela
    echo "<div class='container d-flex justify-content-center'><div class='w-100'>";
    echo "<table class= 'table table-striped table-sm table-hover'>";
    echo "<thead class='table-bordered table-info'>";
    echo "<tr>";
    echo "<th scope='col' colspan='2'class='text-center'>Ações</th>";
    echo "<th scope='col'>Nome</th>";
    echo "<th scope='col'>Endereço</th>";
    echo "<th scope='col'>Tamanho da Pizza</th>";
    echo "<th scope='col'>1° Sabor</th>";
    echo "<th scope='col'>2° Sabor</th>";
    echo "</tr></thead><tbody class='table-striped'>";

    foreach ($clientes as $cliente) {
        echo "<tr>";
        echo '<td align=center>
        <a href="?excluir=' . $cliente['cod_cliente'] . '">( X )</a>
        </td>';
        echo '<td align=center>
        <a href="alterar.php?cod_cliente=' . $cliente['cod_cliente'] . '">( Alterar )</a>
        </td>';
        echo "<td>" . $cliente['nome'] . "</td>";
        echo "<td>" . $cliente['endereco'] . "</td>";
        echo "<td>" . $cliente['tamanho'] . "</td>";
        echo "<td>" . $cliente['sabor1'] . "</td>";
        echo "<td>" . $cliente['sabor2'] . "</td>";
        echo "</tr>";
    }
    echo "</div></div>";
    ?>

</body>

</html>