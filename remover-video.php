<?php


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (empty($id)) {
    header ('Location: /?sucesso=0');
    throw new InvalidArgumentException('O valor do ID é inválido. Deve ser um número inteiro.');
}

$sql = 'DELETE FROM videos WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $id);

try {
    $stmt->execute();
    header('Location: /?sucesso=1');
} catch (PDOException $e) {
    echo "Erro ao executar a Query" . $e->getMessage();
    header('Location: /?sucesso=0');
}
