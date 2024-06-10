<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Poster
{
    private int $id ;
    private string $jpeg;
    public function getId(): int
    {
        return $this->id;
    }
    public function getJpeg(): string
    {
        return $this->jpeg;
    }
    public function findById(int $posterId): Poster
    {
        $req = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id,jpeg
            FROM poster
            WHERE id = {$posterId}
            SQL
        );
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entity\Poster');
        if (($ligne = $req->fetch()) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $ligne;
    }

}
