<?php
/**
*	Parse the request and identify controller, method and arguments
*
*	@package FirstMVC_Core
*/
class CRequest {

	/**
	 *	Initiate (Init) the object by parsing the current url request.
	 */
	public function Init() {
		//	Take the current url and divide it in controller, method and arguments
		$query = substr($_SERVER['REQUEST_URI'], strlen(rtrim(dirname($_SERVER['SCRIPT_NAME']),
			'/')));

		//Debugging
		//echo $query;

		$splits = explode('/', trim($query, '/'));

		//	Set controller, method and arguments
		$controller = !empty($splits[0]) ? $splits[0] : 'index';

		/*
			Attempt of IF-Statement for the above code (for own personal understanding)

			if(!empty($splits[0]))
			{
				$controller = $splits[0];

			}else
			{
				$controller = 'index';
			}
		*/
		$method = !empty($splits[1]) ? $splits[1] : 'index';
		$arguments = $splits;
		unset($arguments[0], $arguments[1]); //remove controller & method part from argument list

		//	Store it
		$this->request_uri = $_SERVER['REQUEST_URI'];
		$this->script_name = $_SERVER['SCRIPT_NAME'];
		$this->query       = $query;
		$this->splits      = $splits;
		$this->controller  = $controller;
		$this->method      = $method;
		$this->arguments   = $arguments;
	}
}