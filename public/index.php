<?php

declare(strict_types=1);

use Html\AppWebPage ;
use Entity\Poster ;
use Entity\Collection\ShowCollection ;

$page = new AppWebPage('Séries TV');
$shows = new ShowCollection();
$allShows = $shows->findAll();
$page->appendContent("<div class='main'>");
foreach ($allShows as $show) {
    $posters = new Poster();
    $page->appendContent(
        <<<HTML
        <a href='/show.php?name={$page->escapeString($show->getName())}'>
            <img src='poster.php?posterId={}'  alt='poster'/>
            <p>{$show->getName()} <br /><br />{$show->getOverview()} </p>          
        </a>
        HTML
    );
    $page->appendContent("<a href ='/show.php?name={$page->escapeString($show->getName())}'></a>");
}
$page->appendContent("</div>");
echo $page->toHTML();
