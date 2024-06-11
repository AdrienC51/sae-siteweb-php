<?php

declare(strict_types=1);

use Entity\Exception\ParameterException;
use Html\Form\ShowForm;

try {
    $showForm = new ShowForm();
    $showForm->setEntityFromQueryString();
    $show = $showForm->getShow();
    $show->save();
    header("Location: /");
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
