<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Show;
use Html\StringEscaper;
use Entity\Exception\ParameterException;
use Html\WebPage;

class ShowForm extends Show
{
    use StringEscaper;

    public ?Show $show;

    public function __construct(?Show $show = null)
    {
        $this->show = $show;
    }
    public function getShow(): ?Show
    {
        return $this->show;
    }

    public function getHtmlForm(string $action): string
    {
        $pageForm = new WebPage("Formulaire de création d'une série");
        $form = <<<HTML
                    <form method="post" action="{$action}">
                        <input name="id" type="hidden" value="{$this?->show?->getId()}">
                        <label>
                            Nom français
                            <input name="name" type="text" value="{$this->stripTagsAndTrim($this->escapeString($this?->show?->getName()))}" required>
                        </label>
                        <label>
                            Nom original
                            <input name="originalName" type="text" value="{$this->stripTagsAndTrim($this->escapeString($this?->show?->getOriginalName()))}" required>
                        </label>
                        <label>
                            Page d'accueil
                            <input name="homepage" type="text" value="{$this->stripTagsAndTrim($this->escapeString($this?->show?->getHomepage()))}" required>
                        </label>
                        <label>
                            Description
                            <input name="overview" type="text" value="{$this->stripTagsAndTrim($this->escapeString($this?->show?->getOverview()))}" required>
                        </label>
                        
                        <button type="submit">Enregistrer</button>
                    </form>
                    HTML;
        $pageForm->appendContent($form);
        return $pageForm->toHTML();
    }

    /**
     * @throws ParameterException
     */
    public function setEntityFromQueryString(): void
    {
        if ((!isset($_POST['name']) || $_POST['name'] == "") ||
            (!isset($_POST['originalName']) || $_POST['originalName'] == "") ||
            (!isset($_POST['homepage']) || $_POST['homepage'] == "") ||
            (!isset($_POST['overview']) || $_POST['overview'] == "")) {
            throw new ParameterException();
        } elseif(isset($_POST['id']) && ctype_digit($_POST['id'])) {
            $this->show = $this->create(
                $this->stripTagsAndTrim($this->escapeString($_POST['name'])),
                $this->stripTagsAndTrim($this->escapeString($_POST['originalName'])),
                $this->stripTagsAndTrim($this->escapeString($_POST['homepage'])),
                $this->stripTagsAndTrim($this->escapeString($_POST['overview'])),
                (int)$_POST['id']
            );
        } else {
            $this->show = $this->create(
                $this->stripTagsAndTrim($this->escapeString($_POST['name'])),
                $this->stripTagsAndTrim($this->escapeString($_POST['originalName'])),
                $this->stripTagsAndTrim($this->escapeString($_POST['homepage'])),
                $this->stripTagsAndTrim($this->escapeString($_POST['overview']))
            );
        }
    }
}
