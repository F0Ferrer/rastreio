<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style02.css">
    <link href="https://fonts.googleapis.com/css?family=Iceberg&display=swap" rel="stylesheet" />
    <title>Document</title>
</head>
<body>
    
<div id="background2">


<div class="quadro">

<?php
    $pdo = new PDO ("mysql: host=localhost; dbname=rastreio","root", "");
?>
<form method="post" class="rastreio">
    <input style= " background-color: rgba(94,110,192,1);"type="text" name="code_rastreio" required>
    <button name="rastrear" value="rastrear" class="botao">Rastrear Pedido!</button>
</form>

<?php

    if(isset($_POST['rastrear'])) {
        $codigo = filter_input(INPUT_POST, 'code_rastreio', FILTER_DEFAULT);

        $consulta = $pdo->prepare("SELECT * FROM si_rastreio WHERE rastreio_codigo = :code");
        $consulta->bindValue(':code', $codigo);
        $consulta->execute();

        $linhas = $consulta->rowCount();

        if($linhas == 0) {
            echo '<div class="codigo">';
            echo 'Não foi encontrado o seu pedido com este código de rastreio: <b>'.$codigo.'</b>, VERIFIQUE a digitação correta do código.';
            echo '</div>';
        } else {
            foreach($consulta as $mostra) {
?>
                <p class="pedido">Pedido: <?= $mostra['rastreio_pedido'] ?></p>
                <p class="data">Data de Postagem: <?= date('d/m/Y H:i:s', strtotime($mostra['rastreio_data'])) ?></p>
                <p class="status">Status: <?= ($mostra['rastreio_status'] == 1 ? 'Enviado' : 'Aguardando o Envio');?></p>
<?php  
            }
        }
    }
?>
</div>
</div>
</body>
</html>