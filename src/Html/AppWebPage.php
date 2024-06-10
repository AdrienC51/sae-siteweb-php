<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title);
    }

    public function toHTML(): string
    {
        $htmlHead = "<head>{$this->getHead()} \n<meta charset=\"UTF-8\"> \n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" /> \n<title>{$this->getTitle()}</title>\n</head>\n";
        $htmlBody = "<body> <div class='header'><h1>{$this->getTitle()}</h1></div> <div class='content'>\n{$this->getBody()}</div> <div class='footer'> Dernière modification : {$this->getLastModification()}</div> </body>";
        return "<!doctype HTML><html lang=\"fr\"> " . $htmlHead . $htmlBody . "</html>";
    }
}
