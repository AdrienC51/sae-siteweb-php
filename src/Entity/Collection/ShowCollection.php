<?php

declare(strict_types=1);

namespace Entity\Collection;

use Entity\Show;
use Database\MyPdo;
use PDO;

class ShowCollection
{
    public function findAll(): array
    {
        $allShow = MyPDO::getInstance()->prepare(
            <<<SQL
                SELECT id, name, originalName, overview
                FROM tvshow
                ORDER BY name
            SQL
        );
        $allShow->execute();
        return $allShow->fetchAll(PDO::FETCH_CLASS, 'Entity\Show');
    }
}
