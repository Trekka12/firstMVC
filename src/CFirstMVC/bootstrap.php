<?php
/**
*	Bootstrapping, setting up and loading the core
*
*	@package FirstMVC_Core
*/

/**
*	Enable auto-load of class declarations.
*/
function autoload($aClassName) {
	$classFile = "/src/{$aClassName}/{$aClassName}.php";
	$file1 = FIRSTMVC_SITE_PATH . $classFile;
	$file2 = FIRSTMVC_INSTALL_PATH . $classFile;

	//Debugging for file1 & file2:
	//echo "<br><br> DEBUGGING BOOTSTRAP:<br>\$file1 = " . $file1 . "<br>";
	//echo "\$file2 = " . $file2;

	if(is_file($file1)) 
	{
		require_once($file1);

	}elseif(is_file($file2))
	{
		require_once($file2);
	}
}
spl_autoload_register('autoload');