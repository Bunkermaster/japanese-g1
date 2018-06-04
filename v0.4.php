<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 04/06/2018
 * Time: 14:37
 */
// define masks
define('MB4_1B_MASK', 0b10000000);
define('MB4_1B_VERF', 0b00000000);
define('MB4_2B_MASK', 0b11100000);
define('MB4_2B_VERF', 0b11000000);
define('MB4_3B_MASK', 0b11110000);
define('MB4_3B_VERF', 0b11100000);
define('MB4_4B_MASK', 0b11111000);
define('MB4_4B_VERF', 0b11110000);
define('MB4_FILLER_MASK', 0b11000000);
define('MB4_FILLER_VERF', 0b10000000);
/**
 * 0b00001010 & 0b10000000 = 0b00000000
 */
// get source string
$source = file_get_contents("source.txt");
// get the string length
$sourceLength = strlen($source);
$expectedFillers = 0;
// loop on the characters
$startTime = microtime(true);
for ($i = 0; $i < $sourceLength; $i++) {
    $ordCurrentChar = ord($source[$i]);
    echo $source[$i];
    if ((MB4_1B_MASK & $ordCurrentChar) === MB4_1B_VERF) {
        $expectedFillers = 0;
    } elseif ((MB4_2B_MASK & $ordCurrentChar) === MB4_2B_VERF) {
        $expectedFillers = 1;
        continue;
    } elseif ((MB4_3B_MASK & $ordCurrentChar) === MB4_3B_VERF) {
        $expectedFillers = 2;
        continue;
    } elseif ((MB4_4B_MASK & $ordCurrentChar) === MB4_4B_VERF) {
        $expectedFillers = 3;
        continue;
    } elseif ((MB4_FILLER_MASK & $ordCurrentChar) === MB4_FILLER_VERF) {
        $expectedFillers--;
    }
    if ($expectedFillers === 0) {
        echo PHP_EOL;
    }
}
echo microtime(true) - $startTime . " seconds".PHP_EOL;
