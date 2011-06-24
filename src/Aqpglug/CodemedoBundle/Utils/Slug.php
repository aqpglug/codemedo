<?php
namespace Aqpglug\CodemedoBundle\Utils;

class Slug
{
    static public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $old_locale = setlocale(LC_CTYPE, 0);
        setLocale(LC_CTYPE, 'es_PE.UTF-8', 'es_PE', 'es');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        setLocale(LC_CTYPE, $old_locale);
        
        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

}
