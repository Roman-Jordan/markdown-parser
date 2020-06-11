<?php
$readme = file_get_contents('./README.md');

class MarkDownParser
{
    protected $string,
        $error,
        //Allowed Chars ASCII Punctuation
        $chars = array(
            // (U+0021–2F),
            '!', '"', '#', '$', '%', '&',
            '\'', '(', ')', '*', '+', ',',
            '-', '.', '/',
            ':', ';', '<',
            //(U+003A–0040)
            '=', '>', '?', '@',
            //(U+005B–0060)
            '[', '\\', ']', '^', '_', '`',
            // (U+007B–007E)              
            '{', '|', '}', '~'
        );

    public function __construct($string)
    {
        if (is_string($string)) {
            // $this->string = utf8_encode($string);
            $string = $this->normalize_eol($string);
            $this->string = $this->string_to_array($string);
        }
        print_r($this->string);
    }

    private function normalize_eol($string)
    {
        return str_replace(["\r\n", "\r"], "\n", $string);
    }

    private function string_to_array($string)
    {
        return explode("\n", $string);
    }

    private function rule_headings($string)
    {
        return '<h1>' . $string . '<h1>';
    }

    public function toHTML()
    {
        print_r($this->string);
        //Auto Load Rules
        $i = 0;
        foreach (get_class_methods($this) as $rule) {
            if (!isset($this->error)) {
                if (strpos($rule, 'rule_') !== false) {
                    print_r ($this->string);
                    $i++;
                    foreach ($this->string as $subString) { 
                        //This should be done in parallel 
                        $this->string[$subString] = $this->$rule($subString);
                        echo $subString;
                    }
                } 

            }
        };

        $this->string = implode("\n", $this->string);
        return $this->string;
    }
}

$md = new MarkDownParser($readme);
echo $md->toHTML();
