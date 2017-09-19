<?php
echo '<h1>Word Game</h1>';
$myfile = fopen("letters.txt", "r");
$subsfile = fopen("subs.txt", "w");
$letterString = fread($myfile, filesize("letters.txt"));
echo 'Your letters are: ' . $letterString;
fclose($myfile);

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

$subs = get_all_substrings($letterString);
echo"<br><br>";
echo "All substrings: ";
for ($i = 0; $i < count($subs); $i++) {
    echo $subs[$i] . ", ";
    fwrite($subsfile, $subs[$i]. "\n");
}
fclose($subsfile);
echo '<br><br><button onclick="history.go(-1);">Back</button>';
