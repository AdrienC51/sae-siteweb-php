<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Poster;
use Entity\Season;
use Entity\Show;

if (isset($_GET['seasonId']) && ctype_digit($_GET['seasonId'])) {
    $seasonId  = htmlspecialchars($_GET['seasonId']);
} else {
    header("Location: http://localhost:8000/index.php");
    exit;
}

$season = (new Season())->findById((int)$_GET['seasonId']);
if (!$season->getId()) {
    http_response_code(404);
    exit;
}
$show = (new Show())->findById($season->getTvShowId());
if (!$show->getId()) {
    http_response_code(404);
    exit;
}

$webPage = new AppWebPage("Séries TV : {$show->getName()}<br />{$season->getName()}");
$webPage->appendCssUrl('css/season.css');


$webPage->appendContent(
    <<<HTML
        <div class="menu_space">
            <nav>
                <a href="index.php">Home</a>
            </nav>
        </div>
        <div class='head_content'>
             <img src='poster.php?posterId={$season->getPosterId()}'  alt='poster'/>
             <div class="head_content_text">
                <a href="/show.php?showId={$show->getId()}">{$show->getName()}</a>
                <p>{$season->getName()}</p>
            </div>
        </div>
        <div class="main_content">
    HTML
);
$listEpisodes = $season->getEpisodes();
foreach ($listEpisodes as $episode) {
    $posters = new Poster();
    $webPage->appendContent(
        <<<HTML
        <div class="content_list">
            <p>{$episode->getEpisodeNumber()} - {$episode->getName()}</p>
            <p>{$episode->getOverview()}</p>
        </div>
        HTML
    );
}
$webPage->appendContent("</div>");
echo $webPage->toHTML();