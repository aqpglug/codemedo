<?php

namespace Aqpglug\CodemedoBundle\Twig;

use \Twig_Extension;
use \Twig_Function_Method;

class Utils extends Twig_Extension
{

    public function getFunctions()
    {
        return array(
            'letter' => new Twig_Function_Method($this, "getLetter"),
        );
    }

    public function getLetter($i)
    {
        return chr($i + 65);
    }

    public function getName()
    {
        return 'codemedo.twig.utils';
    }
}
