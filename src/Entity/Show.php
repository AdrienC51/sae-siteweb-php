<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SeasonCollection;
use PDO;

class Show
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $overview;
    private int $posterId;

    public function getPosterId(): ?int
    {
        if (isset($this->posterId)) {
            return $this->posterId;
        } else {
            return  null ;
        }

    }

    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Show
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Show
    {
        $this->name = $name;
        return $this;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): Show
    {
        $this->originalName = $originalName;
        return $this;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): Show
    {
        $this->overview = $overview;
        return $this;
    }

    public function findById(int $id): Show
    {
        $showRqst = MyPDO::getInstance()->prepare(
            <<<SQL
                SELECT id, name, originalName, overview,posterId
                FROM  tvshow
                WHERE id = $id
            SQL
        );
        $showRqst->execute();
        $showRqst->setFetchMode(PDO::FETCH_CLASS, 'Entity\Show');
        $show = $showRqst->fetch();
        if (empty($show)) {
            http_response_code(404);
        }
        return $show;
    }

    public function getSeasons(): array
    {
        $listSeasons = new SeasonCollection();
        return $listSeasons->findByTvShowId($this->getId());
    }
}
