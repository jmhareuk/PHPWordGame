<?php
$letterAmount = $_POST['letterAmount'];
$letterArray;
$letterNum = $letterAmount;
$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$myfile = fopen("letters.txt", "w");
echo '<h1>Word Game</h1>';
echo 'Your letters are: ';
for ($i=0; $i < $letterNum; $i++) {
    $letterArray[$i] = $letters[mt_rand(0, 25)];
    fwrite($myfile, $letterArray[$i]);
    echo $letterArray[$i];
}

fclose($myfile);
?>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
    </head>
    <body>
        <br><br>
        <form method="post" action="substring.php">
            <input type="submit" name="substrings" value="Create Substrings">
        </form>
        <form method="post" action="permutation.php">
            <input type="submit" name="permutation" value="Create Permutations">
        </form>
        <form method="post" action="words.php">
            <input type="submit" name="substrings" value="Create Words">
        </form>
            
        <br>
        <a href="start.html">Start Over</a>
    </body>
</html>

