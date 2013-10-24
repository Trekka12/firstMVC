<?php

//	Teoretiska lösningen för alternativa länkarna;
// :index.php/controller, etc. &
// :index.php?q=/controller, etc.

//	Skapa lösningen med hjälp av tillägg av 2 extra if-satser som tar hjälp utav substr i PHP;
//	http://se1.php.net/manual/en/function.substr.php

//	Teoretiska modellen kommer att se ut som följer:
//	Steg 1: If länken ser ut som följer (fall 1): index.php/controller/method/arg1/arg2, etc.
//	- index.php = 0-8 = 9 tecken
//	
	if(substr($länken, 0, 9) == "index.php")
	{
		/*
			Gör då som så att strippa länken/$queryn av sin index.php början, och returnera sedan $query som blir över. 
		*/
	}elseif(substr($länken, 0, 12) == "index.php?q=")
	{
		/*
			Gör då som så att strippa bort de 12 första tecknen med substr, och returnera återstoden av länken som $query.
		*/
	}