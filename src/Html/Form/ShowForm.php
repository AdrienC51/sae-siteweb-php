<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Show;

class ShowForm extends Show
{
    public ?Show $show;

    public function __construct(?Show $show = null)
    {
        $this->show = $show;
    }
    public function getShow(): ?Show
    {
        return $this->show;
    }
}
