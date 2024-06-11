<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\Show;

try {
    if(isset($_GET['showId']) && ctype_digit($_GET['showId'])) {
        $show = new Show();
        $show->findById($_GET['showId']);
    } else {
        throw new ParameterException();
    }
    $show->delete();
    header('Location: /');
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
