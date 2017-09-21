<?php
$writeFile = fopen("perms.txt", "w");
fclose($writeFile);
echo '<h1>Word Game</h1>';
$myfile = fopen("letters.txt", "r");

$word2 = fread($myfile, filesize("letters.txt"));
echo 'Your letters are: ' . $word2;
echo '<br><br><button onclick="history.go(-1);">Back</button>';
fclose($myfile);
echo '<br>';
echo "All permutations: <br>";

function permArray($word2)  
		{ 
			$result2 = array(); 
			if(strlen($word2) <= 1)
			{
				$result2[] = $word2; 
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
				$writeFile2 = fopen("perms.txt", "w") or die('Cannot open file: '.$writeFile);
				for($o = 0; $o < count($result2); $o++)
				{		
					fwrite($writeFile2, $result2[$o]."\r\n"); 
				} 
				fclose($writeFile2);
				return $result2;  
			}
		}

permArray($word2);
echo nl2br(file_get_contents("perms.txt"));