<?php

require_once './dbconn.php';

$hoje = new DateTime();
$mesAnterior = new DateTime('-1 month');

$user = json_decode($_COOKIE["sess-sis"]);

$sql = "SELECT cc.data, cc.descricao,  cc.tipo, cc.valor, ctg.nome as categoria,
        cc.usuario
        FROM conta_corrente as cc
        LEFT JOIN categoria as ctg on cc.categoria = ctg.id 
        WHERE data between 
        '" . $mesAnterior->format("Y-m-d") . "' AND '" . $hoje->format("Y-m-d") . "'
        AND usuario = '" . $user->id . "'    
        ORDER BY data DESC";

$result = $dbcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
