<?php

declare(strict_types=1);

namespace Entity\Collection;

use Entity\Episode;
use Database\MyPdo;
use PDO;

class EpisodeCollection
{
    public function findBySeasonId(int $seasonId)
    {
        $episodeRequest = MyPDO::getInstance()->prepare(
            <<<SQL
                SELECT *
                FROM episode
                WHERE seasonId = {$seasonId}
            SQL
        );
        $episodeRequest->execute();
        return $episodeRequest->fetchAll(PDO::FETCH_CLASS, 'Entity\Episode');
    }
}