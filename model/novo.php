<?php

require_once './dbconn.php';

$data = DateTime::createFromFormat("d/m/Y", $_POST['data']);

$valor = ($_POST['tipo'] == "D")? $_POST['valor'] * -1 : $_POST['valor'];

$sql = "INSERT INTO conta_corrente
            ('data','descricao','categoria','tipo','valor', 'usuario')
        VALUES
            ('". $data->format('Y-m-d') ."','". $_POST['descricao'] ."',
             '". $_POST['categoria'] ."','". $_POST['tipo'] ."',
             '". $valor ."','".$_POST['usuario']."')";

$result = $dbcon->exec($sql);

echo json_encode($result);

