<?php

require_once './dbconn.php';

$sql = "INSERT INTO conta_corrente
            ('data','descricao','categoria','tipo','valor')
        VALUES
            ('2016-02-10','Compras supermercado', 'alimentaçao', 'D', -150.23)";


//$result = $dbcon->query($sql)->fetch(PDO::FETCH_ASSOC);

echo json_encode($result);

