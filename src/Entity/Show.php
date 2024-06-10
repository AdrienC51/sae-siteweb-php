<?php

declare(strict_types=1);

namespace Entity;

class Show
{
    private int $id;
    private string $title;
    private string $ogTitle;
    private string $description;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Show
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Show
    {
        $this->title = $title;
        return $this;
    }

    public function getOgTitle(): string
    {
        return $this->ogTitle;
    }

    public function setOgTitle(string $ogTitle): Show
    {
        $this->ogTitle = $ogTitle;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Show
    {
        $this->description = $description;
        return $this;
    }

    public function findById(int $id): Show
    {
        $showRqst = MyPDO::getInstance()->prepare(
            <<<SQL
                SELECT id, name, originalName, overview
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

}