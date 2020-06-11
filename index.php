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
            $this->string = utf8_encode($string);
            $this->normalize_eol();
            $this->string_to_array();
        }
    }

    private function normalize_eol()
    {
        $this->string = str_replace(["\r\n", "\r"], "\n", $this->string);
    }

    /**
     * @method countLines
     * count the number of lines relative to the spec
     * https://github.github.com/gfm/#characters-and-lines
     * A line is a sequence of zero or more characters
     * other than newline (U+000A) or carriage return 
     * (U+000D), followed by a line ending or by the end of file.
     */
    public function countLines()
    {  
        return count($this->string);
        
    }
    private function string_to_array()
    {
        $this->string = explode("\n", $this->string);
    }

    private function rule_headings()
    {
    }

    private function scan_string()
    {
        $unicode = json_decode("\u00fc\u00be\u008c\u00a3\u00a4\u00bc");
    }

    public function toHTML()
    {
        //Auto Load Rules
        foreach (get_class_methods($this) as $rule) {
            if (strpos($rule, 'rule_') !== false) {
                $this->$rule();
            }
        };
        //Errors Hault Production.
        if (!isset($this->error)) {
            $ord =  json_decode("\u00fc\u00be\u008c\u00a3\u00a4\u00bc");
            echo $ord;
            print_r($this->string);
        } else {
            return print_r($this->error);
        }
    }
}

$md = new MarkDownParser($readme);

echo $md->countLines();
