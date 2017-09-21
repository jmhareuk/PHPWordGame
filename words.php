<?php
$clearfile2 = fopen("words2.txt", "w");
fclose($clearfile2);
$clearfile = fopen("words.txt", "w");
fclose($clearfile);
$wordfile = fopen("words.txt", "a");
$FinalWordArray = array();
$lines = file("perms.txt", FILE_IGNORE_NEW_LINES);
$lineCount = 0;

function get_all_substrings($input) {
    $subs = array();
    $length = strlen($input);
    for ($i = 0; $i < $length; $i++) {
        for ($j = $i; $j < $length; $j++) {
            $subs[] = substr($input, $i, ($j - $i) + 1);
        }
    }
    return $subs;
}
//CHANGES----------------------------------------------

function permutations($word) {
    $result = array();
    if (strlen($word) <= 1) {
        $result[] = $word;
        return $result;
    } else {
        for ($i = 0; $i < strlen($word); $i++) {
            $shorter = substr($word, 0, $i) . substr($word, $i + 1);
            $shorterPerms = array();
            $shorterPerms[] = permutations($shorter);

            foreach ($shorterPerms as $value) {
                for ($j = 0; $j < count($value); $j++) {
                    $result[] = $word[$i] . $value[$j];
                }
            }
            unset($value);
        }
        //write the results array to a file each time the function is called
        $writeFile = fopen("words2.txt", "a") or die('Cannot open file: ' . $writeFile);
        for ($o = 0; $o < count($result); $o++) {
            fwrite($writeFile, $result[$o] . "\r\n");
        }
        fclose($writeFile);
        return $result;
    }
}

//CHANGES----------------------------------------------


for ($i = 0; $i < count($lines); $i++) {

    $string = $lines[$i];
    $subs = get_all_substrings($string);
    for ($j = 0; $j < count($subs); $j++) {
        fwrite($wordfile, $subs[$j] . "\n");
        $lineCount++;
    }
}
fclose($wordfile);

//array containing every substring 
$lines2 = file("words.txt", FILE_IGNORE_NEW_LINES);
//takes each substring and finds the permutation of it
for ($i = 0; $i < $lineCount; $i++) {$lines2[$i];
    $word = $lines2[$i];
    permutations($word);
}
//fclose($wordfile2);

$lines3 = file("words2.txt", FILE_IGNORE_NEW_LINES);
$uniquelines3 = array_values(array_unique($lines3));
$lines4 = file("engmix.txt", FILE_IGNORE_NEW_LINES);
$lines4 = array_map('strtoupper', $lines4);


echo '<table><th style="vertical-align: top; padding-right: 200px;">';
echo 'All possible combinations: <br>';
//PRINTS OUT ALL POSSIBLE UNIQUE COMBINATIONS OF THE RANDOM LETTERS
for ($i = 0; $i < count($uniquelines3); $i++) {
    echo $uniquelines3[$i] . "<br>";
}

echo '</th><th style="vertical-align: top;">';
echo 'Found words: <br>';
//FINDS ALL VALUES IN UNIQUELINES3 THAT ARE LOCATED IN THE DICTIONARY FILE
for ($i = 0; $i < count($uniquelines3); $i++) {

    if (in_array($uniquelines3[$i], $lines4)) {
        echo $uniquelines3[$i] . "<br>";
    }
}

echo "</th>";
