<?php
/**
*	Site configuration, this file is changed by user per site.
*
*/

/*
*	Set level of error reporting
*/
error_reporting(-1);
ini_set('display_errors', 1);

/*
*	Define session name
*/
$firstMVC->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);

/*
*	Define server timezone
*/
$firstMVC->config['timezone'] = 'Europe/Stockholm';

/*
*	Define internal character encoding
*/
$firstMVC->config['character_encoding'] = 'UTF-8';

/*
*	Define language
*/
$firstMVC->config['language'] = 'en';