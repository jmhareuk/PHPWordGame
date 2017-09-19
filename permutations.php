<!DOCTYPE html>
<!--	Author: Jeremy Roland
		Date: September 16, 2017
		File: permutations.php
		Purpose: Display the permutations of the random letters from a file
		Input:
		Output: Page that prints the permutations to a file 

-->
<html>
<head>
	<title>Permutations Output</title>
	<link rel ="stylesheet" type="text/css" href="HW3_CSS.css"> 
</head>
<body>
	<h1>Here are the permutations of the random letters</h1>
	<h2>The permutations were printed and saved to the file 'Ass_3_permutations.txt'.</h2>  
	<h2>Printing them all on screen would take up a lot of space.</h2>
	//I used a javascript method to return to the previous page, instead of using the session array
	//Schwab said doing it this was was acceptable. 
	<a href="javascript:history.back()">Return to Previous Page</a> 
	<?php 
		function permutations($word)  
		{
			$result = array(); 
			if(strlen($word) <= 1)
			{
				$result[] = $word; 
				return $result; 
			}
			else
			{
				for($i = 0; $i < strlen($word); $i++)
				{
					$shorter = substr($word, 0, $i).substr($word, $i+1);
					$shorterPerms = array();
					$shorterPerms[] = permutations($shorter); 
					
					foreach($shorterPerms as $value)
					{	
						for($j = 0; $j < count($value);$j++)
						{
							$result[] = $word[$i] . $value[$j];
						} 
					}
					unset($value); 
				}
				//write the results array to a file each time the function is called
				$writeFile = fopen("Ass_3_permutations.txt", "w") or die('Cannot open file: '.$writeFile);
				for($o = 0; $o < count($result); $o++)
				{		
					fwrite($writeFile, $result[$o]."\r\n"); 
				} 
				fclose($writeFile);
				return $result; 
			}
		}
		//Read the random letters from a file
		$myWord = ""; 
		$readFile = fopen("Ass_3_letters.txt", "r");
		while(!feof($readFile))
		{
			$myWord = $myWord.fgets($readFile);
		}
		fclose($readFile);
		permutations($myWord); 
	?>
</body>
</html> 
