<?php

namespace aluraplay\Repository;

use aluraplay\Entity\Users;
use aluraplay\Entity\Video;

class VideoRepository
{
    public function __construct(private \PDO $pdo)
    {
    }

    public function add(Video $video): bool
    {

        $sql = 'INSERT INTO videos (url, title, image_path) VALUES (?, ?, ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $video->url);
        $stmt->bindValue(2, $video->title);
        $stmt->bindValue(3, $video->getFilepath());

        $result = $stmt->execute();
        $id = $this->pdo->lastInsertId();

        $video->setId(intval($id));
        return $result;

    }

    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM videos WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$id);
        return $stmt->execute();
    }

    public function update(Video $video): bool
    {
        $updateImageSql = '';
        if($video->getFilepath() !== null) {
            $updateImageSql = ', image_path = :image_path';
        }
        $sql = "UPDATE videos SET url= :url, title= :title $updateImageSql WHERE id= :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':url', $video->url);
        $stmt->bindValue(':title', $video->title);
        $stmt->bindValue(':id', $video->id, \PDO::PARAM_INT);
        if($video->getFilepath() !== null) {
            $stmt->bindValue(':image_path', $video->getFilepath());
        }

        return $stmt->execute();


    }

    /**
     * @return Video[]
     */
    public function all(): array
    {
        $videoList = $this->pdo
            ->query('SELECT * FROM videos')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateVideo(...),
            $videoList
        );

    }

    public function find(int $id)
    {
        $sql = 'SELECT * FROM videos WHERE id= ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->execute();
        $videoData = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $this->hydrateVideo($videoData);
    }

    public function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['url'], $videoData['title']);
        $video->setId($videoData['id']);
        if ($videoData['image_path'] !== null) {
            $video->setFilepath($videoData['image_path']);
        }
        return $video;

    }

    public function findUser(Users $user): bool
    {
        $sql = 'SELECT * FROM users WHERE email= ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $user->email);
        $stmt->execute();

        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
        $corretPassword = password_verify($user->password, $userData['password'] ?? '');

        return $corretPassword;

    }

    public function removeCapa(int $id)
    {
        $sql = 'UPDATE videos SET image_path = null WHERE id= ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->execute();
    }


}