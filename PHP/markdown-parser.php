<?php 

class MarkDownParser
{
    private function __construct($string)
    {
        if (isset($string)) {
            return 'hello';
        }
    }

    public function toHTML()
    {
        
    }
}

$md = new MarkDownParser('hello');

echo $md;
