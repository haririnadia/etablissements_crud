<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtentionExtension extends AbstractExtension
{


    public function getFunctions(): array
    {
        return [
            new TwigFunction('pluralize', [$this, 'pluralize']),
        ];
    }

    public function pluralize(int $count,string $singular,?string $plural=null):string
    {
        $plural =$plural ?? $singular .'s';
        $resultat = $count===1 ? $singular : $plural;
      return "Il y a $count $resultat de disponible";
    }
}
