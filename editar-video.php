<?php


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'title');

if(empty($id) || empty($url) || empty($title)) {
    header('Location: /?sucesso=0');
    exit();
}

$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':url', $url);
$stmt->bindValue(':title', $title);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
    $stmt->execute();
    header('Location: /?sucesso=1');

} catch(PDOException $e) {
    echo 'ERRO ao executar a consulta' . $e->getMessage();
    header('Location: /?sucesso=0');
}
