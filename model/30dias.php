<?php

$dados[0] = array('data' => '10/06/15', 
    'descricao' => 'McDonalds',
    'categoria' => 'Refeição', 
    'tipo' => 'D', 
    'valor' => 24.89);
$dados[1] = array('data' => '10/06/15', 
    'descricao' => 'Estacionamento',
    'categoria' => 'Veiculo', 
    'tipo' => 'D', 
    'valor' => 8.00);
$dados[2] = array('data' => '8/06/15', 
    'descricao' => 'Salário',
    'categoria' => 'Rendimento', 
    'tipo' => 'C', 
    'valor' => 800.00);

echo json_encode($dados);
