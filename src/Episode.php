<?php

class Episode
{
    private int $Id ;
    private int $season;
    private string $name;
    private string $overwied ;
    private string $episodeNumber ;
    public function getId() {
        return $this->Id ;
    }
    public function getSeason(){
        return $this->season ;
    }
    public function getName() {
        return $this->name ;
    }
    public function getOverwied() {
        return $this->overwied ;
    }
    public function getEpisodeNumber() {
        return $this->episodeNumber ;
    }
    public static function findById(int $id): Episode {
        $req = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT episodeNumber, seasonId
            FROM episode
            ORDER BY episodeNumber,seasonId
            
            SQL
        );
        $req->execute(['EpisodeId' => $id]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'src\Episode');
        if (($ligne = $req->fetch()) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $ligne;
    }

}