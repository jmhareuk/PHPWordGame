<?php
	//This reads the words from the word file (whatever the name of it is) and stores them in an array
	//the trim function trims off the newline characters and blank spaces 
	$dictionary = fopen("name_of_file.txt", "r"); 
	$words = array(); 
	while(!feof($dictionary))
	{
		$words[] = trim(fgets($readFile));
	}
	fclose($readFile); 
	//
	//Make a wordHolder array to hold the match ups that are words from the dictionary file
	//pass in the array holding the possible words, for this test I'll call it possibleWords array 
	$possibleWords = array(); 
	$wordHolder = array(); 
	for($a = 0; $a < count($possibleWords); $a++)
	{
		for($b = 0; $b < count($dictionary); $b++)
		{
			//compare the contents of possibleWords(a) and dictionary(b) 
			//if they are equal, save the contents to the wordHolder array 
			//to avoid duplicates, make it an associative array and have the word be the key and value 
		}
	}
?> 