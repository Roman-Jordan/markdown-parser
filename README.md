# Markdown Parser
Parses markdown files and outputs them to HTML following GFM specifications

## Client
The clinet side version of Markdown Parser allows you to send of Mark down 

## PHP
As this is a single class and has no dependencies, it has been writen in such a way where all one has to do is add the class to their project and include it in one of ones php files. This class autoloads anything all methods with the prefix of `rule_`; that being said, if you are exteninding this class with aditional rules, for them to auto load, you will need to add the prefix of `rule_` to your method.

```php
<?php
include './markdown-parser.php';
$readme = file_getContents('./READ.me');//Returns as a string. 

$md = new MarkDownParser($readme);

echo $md->toHTML();

```