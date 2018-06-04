<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 04/06/2018
 * Time: 14:37
 */
$source = file_get_contents("source.txt");
// get the string length
$sourceLength = mb_strlen($source);
// loop on the characters
for ($i = 0; $i < $sourceLength; $i++) {
    echo mb_substr($source, $i, 1).PHP_EOL;
}
