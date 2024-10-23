<?php

try {
    $stmt = $pdo->query('SELECT * FROM videos;');
    if ($stmt === false) {
        throw new Exception('Falha ao carregar a consulta');
    }
    $videolist = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($videolist)) {
        throw new Exception('Nenhum Video Encontrado');
    }
} catch (PDOException $e) {
    echo 'Erro ao consultar o banco de dados:' . $e->getMessage();
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}

?>
<?php require_once 'inicio-html.php';?>

    <ul class="videos__container" alt="videos alura">
        <?php foreach ($videolist as $video): ?>
            <li class="videos__item">
                <iframe width="100%" height="72%" src="<?= $video['url'] ?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                <div class="descricao-video">
                    <img src="img/logo.png" alt="logo canal alura">
                    <h3><?= $video['title'] ?></h3>
                    <div class="acoes-video">
                        <a href="/editar-video?id=<?=$video['id'];?>">Editar</a>
                        <a href="/remover-video?id=<?=$video['id'];?>">Excluir</a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php require_once 'fim-html.php';?>