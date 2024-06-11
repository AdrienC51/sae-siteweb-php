<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    use StringEscaper;

    private string $head;
    private string $title;
    private string $body;

    /**
     * Constructeur de la classe WebPage
     *
     * @param string $title Titre de la page
     */
    public function __construct(string $title = "")
    {
        $this->title = $title;
        $this->head = "";
        $this->body = "";
    }

    /**
     * Retourne le contenu de $this->head
     *
     * @return string Contenu de $this->head
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * Retourne le contenu de $this->title
     *
     * @return string Contenu de $this->title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Affecte le titre de la page
     *
     * @param string $title Le titre
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Retourne le contenu de $this->body
     *
     * @return string Contenu de $this->body
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Ajoute un contenu dans $this->head
     *
     * @param string $content
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Ajoute un contenu CSS dans $this->head
     *
     * @param string $css Le contenu CSS à ajouter
     */
    public function appendCss(string $css): void
    {
        $this->appendToHead("<style>" . $css . "</style>\n");
    }

    /**
     * Ajoute l'URL d'un script CSS dans $this->head
     *
     * @param string $url L'URL du script CSS
     */
    public function appendCssUrl(string $url): void
    {
        $this->appendToHead("<link href=\"" . $url . "\" rel=\"stylesheet\" type=\"text/css\" />\n");
    }

    /**
     * Ajoute un contenu JavaScript dans $this->head
     *
     * @param string $js Le contenu JavaScript à ajouter
     */
    public function appendJs(string $js): void
    {
        $this->appendToHead("<script>" . $js . "</script>\n");
    }

    /**
     * Ajoute l'URL d'un script JavaScript dans $this->head
     *
     * @param string $url L'URL du script JavaScript
     */
    public function appendJsUrl(string $url): void
    {
        $this->appendToHead("<script src =\"" . $url . "\"></script>\n");
    }

    /**
     * Ajoute un contenu dans $this->body
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * Produit la page Web complète
     *
     * @return string Page Web complète
     */
    public function toHTML(): string
    {
        $htmlHead = "<head>{$this->getHead()} \n<meta charset=\"UTF-8\"> \n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" /> \n<title>{$this->getTitle()}</title>\n</head>\n";
        $htmlBody = "<body> \n{$this->getBody()} </body>";
        return "<!doctype HTML><html lang=\"fr\"> " . $htmlHead . $htmlBody . "</html>";
    }

    /**
     * Protège les caractères spéciaux pouvant dégrader la page Web
     *
     * @param string $string La chaîne à protéger
     * @return string La chaîne protégée
     */

    /**
     * Donne la date et l'heure de la dernière modification du script principal.
     *
     * @return string Date et heure de la dernière modif dans une chaine de caractères
     */
    public function getLastModification(): string
    {
        $dateModif = getlastmod();
        if (!$dateModif) {
            return "Une erreur est survenu";
        } else {
            return date("d/m/o-H:i:s", $dateModif);
        }
    }

}
