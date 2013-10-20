<?php
/*
echo "<h1>I am Lydia - index.php</h1>";
echo "<p>You are most welcome!</p>";
echo "<p>REQUEST_URI - " . htmlentities($_SERVER['REQUEST_URI']) . "</p>";
echo "<p>SCRIPT_NAME - " . htmlentities($_SERVER['SCRIPT_NAME']) . "</p>";
*/

//=================================================================================
//	PHASE:	BOOTSTRAP
//=================================================================================
define('FIRSTMVC_INSTALL_PATH', dirname(__FILE__));
define('FIRSTMVC_SITE_PATH', FIRSTMVC_INSTALL_PATH . '/site');

//Debug-testing of PATH's
echo "FIRSTMVC_INSTALL_PATH: " . FIRSTMVC_INSTALL_PATH . "<br>";
echo "FIRSTMVC_SITE_PATH: " . FIRSTMVC_SITE_PATH;

require(FIRSTMVC_INSTALL_PATH . '/src/CFirstMVC/bootstrap.php');

$firstMVC = CFirstMVC::Instance();


//=================================================================================
//	PHASE:	FRONTCONTROLLER ROUTE
//=================================================================================
$firstMVC->FrontControllerRoute();


//=================================================================================
//	PHASE:	THEME ENGINE RENDER
//=================================================================================
$firstMVC->ThemeEngineRender();