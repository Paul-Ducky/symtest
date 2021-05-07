<?php


namespace App\Twig;


 use Twig\Extension\AbstractExtension;
 use Twig\TwigFilter;

 class Extension extends AbstractExtension
{
     public function getFilters(){

         return [
             new TwigFilter('reversedCapital',[$this, 'reversedCapital']),
         ];
     }

     public function reversedCapital(string $str = null){
         return strrev(ucwords(strrev(strtolower($str))));
     }
}