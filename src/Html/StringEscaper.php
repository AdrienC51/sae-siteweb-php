<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    public function escapeString(?string $string): string
    {
        if (is_null($string)) {
            return "";
        } else {
            return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_XHTML);
        }
    }

    public function stripTagsAndTrim(?string $text): string
    {
        if (is_null($text)) {
            return "";
        } else {
            $text = strip_tags($text);
            $text = trim($text);
            return $text;
        }
    }
}
