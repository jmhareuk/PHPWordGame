<?php
set_time_limit(120);
//Clears both files
$clearfile2 = fopen("words2.txt", "w");
fclose($clearfile2);
$clearfile = fopen("words.txt", "w");
fclose($clearfile);

$wordfile = fopen("words.txt", "a");

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
$wordfile2 = fopen("words2.txt", "a");
function pc_permute($items, $perms = array()) {
    
    if (empty($items)) {
        print join('', $perms) . "<br>";
        fwrite($GLOBALS['wordfile2'], join('', $perms));
        fwrite($GLOBALS['wordfile2'], "\n");
        
        
    } else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
            $newitems = $items;
            $newperms = $perms;
            list($foo) = array_splice($newitems, $i, 1);
            array_unshift($newperms, $foo);
            pc_permute($newitems, $newperms);
        }
    }
    
}

for ($i = 0; $i < count($lines); $i++) {

    $string = $lines[$i];
    $subs = get_all_substrings($string);
    for ($j = 0; $j < count($subs); $j++) {
        fwrite($wordfile, $subs[$j] . "\n");
        $lineCount++;
    }
    
}
fclose($wordfile);
$lines2 = file("words.txt", FILE_IGNORE_NEW_LINES);

for ($i = 0; $i < $lineCount; $i++) {
    $temp_string = $lines2[$i];
    $LetterArray = str_split($temp_string);
    pc_permute($LetterArray);
}
fclose($wordfile2);

$lines2 = file("perms.txt", FILE_IGNORE_NEW_LINES);
echo '<br><br><button onclick="history.go(-1);">Back</button>';