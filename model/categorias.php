<?php

require_once './dbconn.php';

$sql = "SELECT * FROM categoria";

$result = $dbcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);