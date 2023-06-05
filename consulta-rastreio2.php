<?php
    $pdo = new PDO ("mysql: host=localhost; dbname=rastreio","root", "");
?>
<form method="post">
    <input type="text" name="code_rastreio" required>
    <button name="rastrear" value="rastrear">Rastrear Pedido!</button>
</form>

<?php
date_default_timezone_set ("America/Sao_Paulo");
echo date_default_timezone_get ();
?>

<?php
    if(isset($_POST['rastrear']));
        $codigo = filter_input($INPUT_POST, 'code_rastreio', FILTER_DEFAULT);

        $consulta = $pdo -> prepare("SELECT * FROM si_rastreio WHERE rastreio_codigo = :code");
        $consulta -> bindValue(':code',$codigo);
        $consulta -> execute();

        $linhas = $consulta -> rowCount();

        if($linhas == 0):
            echo 'Não foi encontrado o seu pedido com este código de rastreio: <b>'.$codigo.'</b>,
            VERIFIQUE a digitaçâo correta do código.';
        else:
            foreach($consulta as $mostra):
            
?>
    <p>Pedido: <?= $mostra['rastreio_pedido'] ?></p>
    <p>Data de Postagem: <?= date('d/m/Y H:i:s', strtotime($mostra['rastreio_data'])) ?></p>
    <p>Status: <?= ($mostra['rastreio_status'] == 1? 'Enviado' : 'Aguardando o Envio');?></p>
 <?php  
            endforeach;
        endif;
    endif;
?>