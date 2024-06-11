<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SeasonCollection;
use PDO;

class Show
{
    private ?int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private ?int $posterId=null;

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }


    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    public function setPosterId(?int $posterId): void
    {
        $this->posterId = $posterId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): void
    {
        $this->originalName = $originalName;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
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

    public function create(string $name,string $originalName,string $homepage, string $overview, ?int $id = null): Show
    {
        $show = new Show();
        $show->setId($id);
        $show->setName($name);
        $show->setOriginalName($originalName);
        $show->setHomepage($homepage);
        $show->setOverview($overview);
        return $show;
    }

    public function delete(): Show
    {
        $showDelete = MyPDO::getInstance()->prepare(
            <<<SQL
                DELETE FROM tvshow
                WHERE id={$this->getId()}
            SQL
        );
        $showDelete->execute();
        $this->setId(null);
        return $this;
    }

    protected function update(): Show
    {
        $showUpdate = MyPDO::getInstance()->prepare(
            <<<SQL
                UPDATE tvshow
                SET name='{$this->getName()}',
                    originalName='{$this->getOriginalName()}',
                    homepage='{$this->getHomepage()}',
                    overview='{$this->getOverview()}',
                    posterId='{$this->getPosterId()}'
                WHERE id={$this->getId()}
            SQL
        );
        $showUpdate->execute();
        return $this;
    }



}
