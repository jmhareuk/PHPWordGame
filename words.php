<?php

$clearfile2 = fopen("words2.txt", "w");
fclose($clearfile2);
$clearfile = fopen("words.txt", "w");
fclose($clearfile);

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
//Generate permutations from the random letters
function initialPermArray($word3)  
		{ 
			$result2 = array(); 
			if(strlen($word3) <= 1)
			{
				$result2[] = $word3; 
				$writeFile2 = fopen("perms.txt", "w") or die('Cannot open file: '.$writeFile);
				for($o = 0; $o < count($result2); $o++)
				{		
					fwrite($writeFile2, $result2[$o]."\r\n"); 
				} 
				fclose($writeFile2);
				return $result2; 
			}
			else
			{
				for($i = 0; $i < strlen($word3); $i++)
				{
					$shorter2 = substr($word3, 0, $i).substr($word3, $i+1);
					$shorterPerms2 = array();
					$shorterPerms2[] = permArray($shorter2); 
					
					foreach($shorterPerms2 as $value2)
					{	
						for($j = 0; $j < count($value2);$j++)
						{
							$result2[] = $word3[$i] . $value2[$j];
						} 
					}
					unset($value2); 
				}
				$writeFile2 = fopen("perms.txt", "w") or die('Cannot open file: '.$writeFile);
				for($o = 0; $o < count($result2); $o++)
				{		
					fwrite($writeFile2, $result2[$o]."\r\n"); 
				} 
				fclose($writeFile2);
				return $result2;  
			}
		}


$myfile = fopen("letters.txt", "r");
$word3 = fread($myfile, filesize("letters.txt"));
fclose($myfile);
InitialPermArray($word3);


function permArray($word2)  
		{ 
			$result2 = array(); 
			if(strlen($word2) <= 1)
			{
				$result2[] = $word2; 
				$writeFile2 = fopen("words2.txt", "a") or die('Cannot open file: '.$writeFile);
				for($o = 0; $o < count($result2); $o++)
				{		
					fwrite($writeFile2, $result2[$o]."\r\n"); 
				} 
				fclose($writeFile2);
				return $result2; 
			}
			else
			{
				for($i = 0; $i < strlen($word2); $i++)
				{
					$shorter2 = substr($word2, 0, $i).substr($word2, $i+1);
					$shorterPerms2 = array();
					$shorterPerms2[] = permArray($shorter2); 
					
					foreach($shorterPerms2 as $value2)
					{	
						for($j = 0; $j < count($value2);$j++)
						{
							$result2[] = $word2[$i] . $value2[$j];
						} 
					}
					unset($value2); 
				}
				$writeFile2 = fopen("words2.txt", "a") or die('Cannot open file: '.$writeFile);
				for($o = 0; $o < count($result2); $o++)
				{		
					fwrite($writeFile2, $result2[$o]."\r\n"); 
				} 
				fclose($writeFile2);
				return $result2;  
			}
		}
//Generate substrings              
$wordfile = fopen("words.txt", "a");
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
for ($i = 0; $i < $lineCount; $i++) {
    $lines2[$i];
    $word2 = $lines2[$i];
    permArray($word2);
}

//read in files and store them as an array
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
