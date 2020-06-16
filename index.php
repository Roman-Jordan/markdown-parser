<?php
$readme = file_get_contents('./README.md');
require_once './PHP/markdown-parser.php';
$md = new MarkDownParser($readme);
echo $md->toHTML();
