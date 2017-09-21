<!DOCTYPE html>
<!--	Author: Jeremy Roland
		Date: September 18, 2017
		File: possibleWords.php
		Purpose: Display the possible words from a file 
		Input:
		Output: Page that prints the possible words 

-->
<html>
<head>
	<title>Possible Words</title>
	<link rel ="stylesheet" type="text/css" href="HW3_CSS.css"> 
</head>
<body>
	<h1>List of Words</h1>
	<h2>Below is each possible word from your random letters:</h2> 
	<?php 
		//make a practice string, permute it and write it to a file, then get the substrings, then permute those substrings 
		$practiceWord = "abc"; 
		$wordLength = strlen($practiceWord); 
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
				$writeFile = fopen("Ass_3_P1holder.txt", "w") or die('Cannot open file: '.$writeFile);
				for($o = 0; $o < count($result); $o++)
				{		
					fwrite($writeFile, $result[$o]."\r\n"); 
				} 
				fclose($writeFile);
				return $result; 
			}
		}
		permutations($practiceWord);
	?>
	<?php 
		//get the substrings 
		$substrings = array();
		$myWord = array(); 
		$readFile = fopen("Ass_3_P1holder.txt", "r");
		while(!feof($readFile))
		{
			$myWord[] = trim(fgets($readFile));
		}
		fclose($readFile); 
		print("<p>Here are the permutations read from the file:</p>"); 
		print("<pre>");
		print_r($myWord);
		print("</pre>");  
		print("<p>Note: not sure why there is a blank space at the end, but I adjust for the excess length of the array in the code. </p>");
		
		$longLength = count($myWord); 
		$longLength--; 
		//fill the substrings array to a specified amount
		//that specified amount is the number of permutations read from the file 
		//this is done so the substrings array will have pre-made space to fill with the substrings of the permutations (I avoid an error by doing this) 
		//for($a = 0; $a < $longLength; $a++)
		//{
			//$substrings[] = " "; 
		//}
		//outer loop iterates over myWord array
			//inner loops get the substrings and assign them to a new array 
			//all substrings are held in the same element in the array 
		for($r = 0; $r < $longLength; $r++)
		{
			for($i = 0; $i < $wordLength; $i++)
			{
				for($j = $i+1; $j <= $wordLength; $j++)
				{
					$temp = substr($myWord[$r], $i, $j-$i);					
					$substrings["$temp"] = $temp; 
				}
			}
		}
		print("<p>These are the substrings of those permutations: </p>"); 
		print("<pre>");
		print_r($substrings);
		print("</pre>");
?>

<?php		 
		  
		//call the permutations function on each element of the substrings array 
		function permArray($word2)  
		{ 
			$result2 = array(); 
			if(strlen($word2) <= 1)
			{
				$result2[] = $word2; 
				$writeFile2 = fopen("Ass_3_P3holder.txt", "w") or die('Cannot open file: '.$writeFile);
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
				$writeFile2 = fopen("Ass_3_P3holder.txt", "w") or die('Cannot open file: '.$writeFile);
				for($o = 0; $o < count($result2); $o++)
				{		
					fwrite($writeFile2, $result2[$o]."\r\n"); 
				} 
				fclose($writeFile2);
				return $result2;  
			}
		}
		
		$possibleWords = array(); 
		
		foreach($substrings as $key)
		{
			//get the key for the associative array, then call the permArray function on the value
			//once the function is called, read the file created during the calling, and read the contents
			permArray($substrings["$key"]); 
			$wordHolder = "";			
			$readFile = fopen("Ass_3_P3holder.txt", "r");
			while(!feof($readFile))
			{
				$wordHolder = $wordHolder.fgets($readFile);
			}
			fclose($readFile);
			//print("<p>Permutations of substrings($key): $wordHolder</p>");
			$possibleWords[] = $wordHolder; 
		}
		for($v = 0; $v < count($possibleWords); $v++)
		{
			print("<p>$possibleWords[$v]</p>");
		}
	?>
	<?php
		//$dictWord = "";  
		$dictWord = array(); 
		$realWords = array(); 
		$dictFile = fopen("engmix.txt", "r");
			while(!feof($dictFile))
			{
				//$dictWord = ""; 
				$dictWord[] = trim(fgets($dictFile));
			}
			fclose($dictFile); 
			for($m = 0; $m < count($possibleWords); $m++)
				{
					//if($possibleWords[$m] == $dictWord[$n])
					if(in_array($possibleWords[$m], $dictWord))
					{
						print("<p>They are equal</p>");
						$realWords["$possibleWords[$m]"] = $possibleWords[$m];
					}
					else
					{
						print("<p>This didn't work</p>");
					}
				}
			//for($n = 0; $n < count($dictWord); $n++)
			//{
				
				
			//}
			
			print("<p>Here are the word generated by your random letters: </p>");
			foreach($realWords as $myKey)
			{ 
				print("<p>$realWords[$myKey]</p>");
			}
?> 
	
</body>
</html>