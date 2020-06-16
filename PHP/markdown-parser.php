<?php
class MarkDownParser
{
    protected $string,
              $error;

    public function __construct($string)
    {
        if (is_string($string)) {
            $string = $this->normalize_eol($string);
            $this->string = $this->string_to_array($string);
        }
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
        if (strpos($string, '#') === 0) {

            $hash = explode(' ', $string, 2);
            $count = substr_count($hash[0], '#');
            if ($count === strlen($hash[0])) {
                return '<h' . $count . '>' . $hash[1] . '</h' . $count . '>';
            }
            return $string;
        };
        return $string;
    }

    public function toHTML()
    {
        foreach (get_class_methods($this) as $rule) {
            if (!isset($this->error)) {
                if (strpos($rule, 'rule_') !== false) {
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