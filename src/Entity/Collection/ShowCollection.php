<?php

declare(strict_types=1);

namespace Entity\Collection;

use Entity\Show;
use Database\MyPdo;
use PDO;

class ShowCollection
{
    public function findAll(int $genreId = null): array
    {
        if (empty($genreId)) {
            $allShow = MyPDO::getInstance()->prepare(
                <<<SQL
                    SELECT id, name, originalName, overview, posterId
                    FROM tvshow
                    ORDER BY name
                SQL
            );
        } else {
            $allShow = MyPDO::getInstance()->prepare(
                <<<SQL
                    SELECT DISTINCT t.id, name, originalName, overview, posterId
                    FROM tvshow t
                    JOIN tvshow_genre tvg on (t.id = tvg.tvShowId) 
                    WHERE tvg.genreId = {$genreId}
                    ORDER BY name
                SQL
            );
        }
        $allShow->execute();
        return $allShow->fetchAll(PDO::FETCH_CLASS, 'Entity\Show');
    }
}
