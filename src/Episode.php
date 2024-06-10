<?php

class Episode
{
    private int $id ;
    private int $seasonId;
    private string $name;
    private string $overview ;
    private string $episodeNumber ;
    public function getId() {
        return $this->id ;
    }
    public function getSeasonId(){
        return $this->seasonId ;
    }
    public function getName() {
        return $this->name ;
    }
    public function getOverview() {
        return $this->overview ;
    }
    public function getEpisodeNumber() {
        return $this->episodeNumber ;
    }
    public static function findById(int $id): Episode {
        $req = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id,episodeNumber, seasonId,name,overview
            FROM episode
            ORDER BY episodeNumber,seasonId,name
            
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