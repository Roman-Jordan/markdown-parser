<?php
class MarkDownParser
{
    protected $string,
        $newString = array(),
        $error;

    public function __construct($string)
    {
        if (is_string($string)) {
            $string = htmlentities($this->normalize_eol($string));
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

    private function rule_atxheadings($string)
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

    private function rule_Tabs($string, $index)
    {
        if (strpos($string, '   ') === 0) {
            if (strpos($this->string[$index - 1], '   ') !== 0) {
                $string = '<pre>' . $string;
            }
            if (strpos($this->string[$index + 1], '   ') !== 0) {
                $string = $string . '</pre>';
            }
        };
        return $string;
    }


    public function toHTML()
    {
        foreach ($this->string as $key => $subString) {
            if (!isset($this->error)) {
                foreach (get_class_methods($this) as $rule) {
                    if (strpos($rule, 'rule_') !== false) {
                        if(isset($this->newString[$key])){
                            $this->newString[$key] = $this->$rule($this->newString[$key], $key);
                        }else{
                            $this->newString[$key] = $this->$rule($subString, $key);
                        }
                    }
                }
            }
        };
        $this->newString = implode("\n", $this->newString);
        return $this->newString;
    }
}
