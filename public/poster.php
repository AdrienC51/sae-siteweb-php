<?php

declare(strict_types=1);

use Entity\Poster;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    if (!isset($_GET["posterId"]) || !is_numeric($_GET["posterId"])) {
        $defaultUrl = 'http://cutrona/but/s2/sae2-01/ressources/public/img/default.png';
        $defaultPoster = file_get_contents("$defaultUrl");
        header("Content-Type: image/png");
        echo $defaultPoster;
        throw new ParameterException();
    }
    $serie = (new Poster())->findById((int)($_GET["posterId"])) ;
    header("Content-Type: image/jpeg");
    echo $serie->getJpeg();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
