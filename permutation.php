<?php
$writeFile = fopen("perms.txt", "w");
fclose($writeFile);
echo '<h1>Word Game</h1>';
$myfile = fopen("letters.txt", "r");

$word = fread($myfile, filesize("letters.txt"));
echo 'Your letters are: ' . $word;
fclose($myfile);
echo '<br>';
echo "All permutations: <br>";

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
        $writeFile = fopen("perms.txt", "w") or die('Cannot open file: ' . $writeFile);
        for ($o = 0; $o < count($result); $o++) {
            fwrite($writeFile, $result[$o] . "\r\n");
        }
        fclose($writeFile);
        return $result;
    }
}
echo nl2br(file_get_contents( "perms.txt" ));
permutations($word);
