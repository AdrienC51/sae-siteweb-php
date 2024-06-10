<?php
declare(strict_types=1);

use html\WebPage ;
use Entity\Episode;
use Entity\Poster ;
use Entity\Show ;

echo "Hello bienvenue sur notre site";

$Page = New WebPage();
$Page->setTitle("Séries TV");
$Page->appendContent("<div> class='menu' <a href ='src/Entity/Episode.php?name={$name->getName()}'>Titre Serie</a></div>");
