<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Season
{
    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private ?int $posterId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    public function findById(int $id): Show
    {
        $seasonRqst = MyPDO::getInstance()->prepare(
            <<<SQL
                SELECT *
                FROM  season
                WHERE id = {$id}
            SQL
        );
        $seasonRqst->execute();
        $seasonRqst->setFetchMode(PDO::FETCH_CLASS, 'Entity\Season');
        $season = $seasonRqst->fetch();
        if (empty($season)) {
            http_response_code(404);
        }
        return $season;
    }
}