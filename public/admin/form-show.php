<?php

declare(strict_types=1);

use Entity\Exception\ParameterException;
use Entity\Exception\EntityNotFoundException;
use Entity\Show;
use Html\Form\ShowForm;

$show = null;

try {
    if (isset($_GET['showId'])) {
        if (ctype_digit($_GET['showId'])) {
            $show = new Show();
            $show->findById((int)$_GET['showId']);
        } else {
            throw new ParameterException();
        }
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
$showForm = new showForm($show);
print($showForm->getHtmlForm('save-show.php'));
