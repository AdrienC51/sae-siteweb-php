<?php

declare(strict_types=1);

namespace Entity\Collection;

use Entity\Season;
use Database\MyPdo;
use PDO;

class SeasonCollection
{
    public function findByTvShowId(int $showId){
        $seasonRequest = MyPdo::getInstance()->prepare(
            <<<SQL
                SELECT *
                FROM season
                WHERE tvShowId = {$showId}
            SQL
        );
        $seasonRequest->execute();
        return $seasonRequest->fetchAll(PDO::FETCH_CLASS, 'Entity\Season');
    }
}