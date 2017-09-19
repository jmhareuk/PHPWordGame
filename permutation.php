<?php
echo '<h1>Word Game</h1>';
$myfile = fopen("letters.txt", "r");

$letterString = fread($myfile, filesize("letters.txt"));
echo 'Your letters are: ' . $letterString;
fclose($myfile);
$LetterArray = str_split($letterString);
echo '<br>';
echo "All permutations: <br>";
$permfile = fopen("perms.txt", "w");
fclose($permfile);


function pc_permute($items, $perms = array( )) {
    $permfile = fopen("perms.txt", "a");
    if (empty($items)) { 
        print join('', $perms) . "<br>";
        fwrite($permfile, join('', $perms));
        fwrite($permfile, "\n");
    }  else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
             list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             pc_permute($newitems, $newperms);
         }
    }
    fclose($permfile);
}

pc_permute($LetterArray);
echo '<br><br><button onclick="history.go(-1);">Back</button>';