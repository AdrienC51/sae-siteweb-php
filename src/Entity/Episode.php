<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Episode
{
    private int $id ;
    private int $seasonId;
    private string $name;
    private string $overview ;
    private string $episodeNumber ;
    public function getId()
    {
        return $this->id ;
    }
    public function getSeasonId()
    {
        return $this->seasonId ;
    }
    public function getName()
    {
        return $this->name ;
    }
    public function getOverview()
    {
        return $this->overview ;
    }
    public function getEpisodeNumber()
    {
        return $this->episodeNumber ;
    }
    public static function findById(int $id): Episode
    {
        $req = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT *
            FROM episode
            WHERE id = {$id}
            ORDER BY episodeNumber,seasonId,name
            SQL
        );
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entity\Episode');
        if (($ligne = $req->fetch()) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $ligne;
    }

}
