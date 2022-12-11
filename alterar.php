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

    </style>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=pizzaria', 'root', '');

if (isset($_GET['cod_cliente'])) {
    $cod_cliente = (int)$_GET['cod_cliente'];
    //mount form whit data
    $sql = $pdo->prepare("SELECT * FROM tab_cadastro WHERE cod_cliente = $cod_cliente");
    $sql->execute();
    $clientes = $sql->fetchAll();

    //montar formulário com os dados dos clientes
    foreach ($clientes as $cliente) {
        echo "<form method='POST'>";
        echo "<legend>Insira os dados abaixo</legend>";
        echo "<fieldset>";
        echo "<div>";
        echo "Nome: <input type='text' class='form-control' name='nome' value='" . $cliente['nome'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "Matrícula: <input type='text' class='form-control' name='endereco' value='" . $cliente['endereco'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "Nota 1: <input type='text' class='form-control' name='tamanho' value='" . $cliente['tamanho'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "Nota 2: <input type='text' class='form-control' name='sabor1' value='" . $cliente['sabor1'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "Nota 3: <input type='text' class='form-control' name='sabor2' value='" . $cliente['sabor2'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
        echo "<input type='reset' class='btn btn-primary' value='Limpar Dados'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
    }

    //$pdo->exec("DELETE FROM `tab_cadastro` WHERE `cod_cliente` = $cod_cliente");
    //echo "<h1>Usuário com id = $cod_cliente deletado com sucesso!</h1>";
}

if (isset($_POST['nome'])) {
    //$sql = $pdo->prepare("INSERT INTO tab_cadastro VALUES (null, ?, ?, ?, ?, ?)");
    //$sql->execute(array($_POST['nome'], $_POST['endereco'], $_POST['tamanho'], $_POST['sabor1'], $_POST['sabor2']));
    //alterando dados da tabela tab_cadastro com os dados do form
    $sql = $pdo->prepare("UPDATE tab_cadastro SET nome = ?, endereco = ?, tamanho = ?, sabor1 = ?, sabor2 = ? WHERE cod_cliente = $cod_cliente");
    $sql->execute(array($_POST['nome'], $_POST['endereco'], $_POST['tamanho'], $_POST['sabor1'], $_POST['sabor2']));
    echo "<h1>Cliente com id = $cod_cliente alterado com sucesso!</h1>";
    //fazer botao para voltar para a pagina de listagem
    echo "<a href='index.php'>Voltar</a>";

    //echo "<h1>Alterado com sucesso!</h1>";
}
?>