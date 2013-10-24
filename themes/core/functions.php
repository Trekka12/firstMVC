<?php
/**
*	Helpers for the template file.
*/
$firstMVC->data['header']	= '<h1>Header: FirstMVC</h1>';
$firstMVC->data['main']		= '<p>Main: Now with a theme engine, Not much more to report for now.</p>';
$firstMVC->data['footer']	= '<p>Footer: &copy; FirstMVC by Trekka12</p>';

/**
*	Print debuginformation from the framwork.
*/
function get_debug() {
	$firstMVC = CFirstMVC::Instance();
	$html = "<h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" .
				htmlentities(print_r($firstMVC->config, true)) . "</pre>";
	$html .= "<hr><p>The content of the data array:</p><pre>" . htmlentities(print_r($firstMVC->data, true)) . "</pre>";
	$html .= "<hr><p>The content of the request array:</p><pre>" . htmlentities(print_r($firstMVC->request, true)) . "</pre>";
	return $html;
}