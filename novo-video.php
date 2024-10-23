<?php

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'title');

if(empty($url) || empty($title)){
    header('Location: /?sucesso=0');
    exit();
}
$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1,$url);
$stmt->bindValue(2, $title);
try {
    $stmt->execute();
    header('Location: /?sucesso=1');
}catch(PDOException $e) {
    echo 'ERRO ao executar a consulta' . $e->getMessage();
    header('Location: /?sucesso=0');
}

