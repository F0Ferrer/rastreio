<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style01.css">
    <link href="https://fonts.googleapis.com/css?family=Iceberg&display=swap" rel="stylesheet" />
</head>
<body class="background">



<?php
    $pdo = new PDO ("mysql: host=localhost; dbname=rastreio","root", "");
?>
<?php
echo '<section class="background">';
echo '<div class="quadro">';
?>

<form method="post">
    <button name="rastreio" value="rastreio" class= "gerar">Gerar Código de Rastreio</button>
</form>

<?php
    if(isset($_POST['rastreio'])):
        $pedido = '123';
        $codigo = rand(10000000, 1000000000);

        $data = date('Y-m-d H:i:s');
        $status = 1;

        $inseri = $pdo->prepare("INSERT INTO si_rastreio (rastreio_pedido, rastreio_codigo,rastreio_data, rastreio_status) VALUES (:pedido, :code, :data, :stat)");
        $inseri -> bindValue(':pedido', $pedido);
        $inseri -> bindValue(':code', $codigo);
        $inseri -> bindValue(':data', $data);
        $inseri -> bindValue(':stat', $status);
        $inseri -> execute();

        if($inseri):
            echo '<div class="codigo">';
            echo 'Seu código de rastreio é: <b>'.$codigo.'</b><br>'; echo '</div>';
        else:
            echo 'Seu código de rastreio nâo pode ser gerado.';
        endif;
    endif;
?>

<?php


$mercadoria = array(
    "Manteiga de Cacau",
    "Hotwheels",
    "Rolex",
    "Carmed de Fini",
    "Ursinho de Pelúcia"
);

$produtos = array_rand($mercadoria);

echo '<div class="produto">';
echo "Produto: " . $mercadoria[$produtos];
echo "<br>";
echo '</div>';

$precos = array(
    "29,90",
    "2,99",
    "8,99",
    "9,99",
    "10,99",
    "11,99",
    "12,99",
    "13,99",
    "14,99",
    "15,99",
    "19,99",
    "35,99"
);

$valor = array_rand($precos);

echo '<div class="valor">';
echo "Valor: " . $precos[$valor];
echo "<br>";
echo '</div>';

$cidades = array(
    "São Paulo",
    "Rio de Janeiro",
    "Belo Horizonte",
    "Salvador",
    "Brasília",
    "Curitiba",
    "Fortaleza",
    "Manaus",
    "Porto Alegre",
    "Recife",
    "Belém",
    "Goiânia"
);

$origem = array_rand($cidades);
$destino = array_rand($cidades);

while($origem === $destino) {
    $destino = array_rand($cidades);
}

echo '<div class="origem">';
echo "Origem: " . $cidades[$origem];
echo "<br>";
echo '</div>';

echo '<div class="destino">';
echo "Destino: " . $cidades[$destino];
echo "<br>";
echo '</div>';


?>
<div class= "rastrear">
<a href="consulta-rastreio.php">Rastrear Pedido!!</a>
</div>
</body>
</html>