<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Poster;
use Entity\Show;

if (isset($_GET['showId']) && ctype_digit($_GET['showId'])) {
    $showId  = htmlspecialchars($_GET['showId']);
} else {
    header("Location: http://localhost:8000/index.php");
    exit;
}

$show = (new Show())->findById((int)$showId);
if (!$show->getId()) {
    http_response_code(404);
    exit;
}

$webPage = new AppWebPage("Séries TV : {$show->getName()}");
$webPage->appendCssUrl('css/fichier.css');


$webPage->appendContent(
    <<<HTML
        <div class="menu_space">
           <nav>
                <a href="index.php">Home</a>
                <a href="admin/form-show.php?showId={$show->getId()}">Edit TVShow</a>
                <a href="admin/delete-show.php?showId={$show->getId()}">Delete TVShow</a>
            </nav>
        </div>
        <div class='head_content'>
             <img src='poster.php?posterId={$show->getPosterId()}'  width="150" height="200"/>
             <div class="head_content_text">
                <p>{$show->getName()}<br />{$show->getOriginalName()}</p>
                <p>{$show->getOverview()}</p>
            </div>
        </div>
        <div class="main_content">
    HTML
);
$listSeasons = $show->getSeasons();
foreach ($listSeasons as $season) {
    $posters = new Poster();
    $webPage->appendContent(
        <<<HTML
        <a href='/season.php?seasonId={$season->getId()}'>
            <img src='poster.php?posterId={$season->getPosterId()}'  width="150" height="200"/>
            <p>{$season->getName()}</p>          
        </a>
        HTML
    );
}
$webPage->appendContent("</div>");
echo $webPage->toHTML();
