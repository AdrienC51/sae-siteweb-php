<?php

declare(strict_types=1);

use Html\AppWebPage ;
use Entity\Poster ;
use Entity\Collection\ShowCollection ;


$page = new AppWebPage('Séries TV');
$page->appendCssUrl('css/index.css');
$shows = new ShowCollection();

if (isset($_GET['genreId']) && ctype_digit($_GET['genreId'])) {
    $allShows = $shows->findAll((int)$_GET['genreId']);
} else {
    $allShows = $shows->findAll();
}
$page->appendContent(
    <<<HTML
    <div class="menu_space">
        <nav>
            <a href="admin/form-show.php">Create Show</a>
        </nav>
    </div>
    HTML
);
$page->appendContent("<div class='main'>");

foreach ($allShows as $show) {
    $posters = new Poster();
    $page->appendContent(
        <<<HTML
        <a href='/show.php?showId={$show->getId()}'>
            <img src='poster.php?posterId={$show->getPosterId()}'  width="150" height="200"/>
            <p>{$show->getName()} <br /><br />{$show->getOverview()} </p>          
        </a>
        HTML
    );
}
$page->appendContent("</div>");
echo $page->toHTML();
