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
	public function Init($baseUrl = null) {
		//For debug-information
		$debugString = "";
		//==========================================================================
		//	Take the current url and divide it in controller, method and arguments
		//==========================================================================
		$query = substr($_SERVER['REQUEST_URI'], strlen(rtrim(dirname($_SERVER['SCRIPT_NAME']),
			'/')));

		#Debugging of $query:
		$debugString .= "Echoa ut \$queryn: " . $query . "<br><br>\n";
		#-------------------------------------------------------------

		$splits = explode('/', trim($query, '/'));

		#Debugging of $splits content:
		$debugString .= "Echoa ut \$splits och dess innehåll: " . print_r($splits, true) . "<br><br>\n";
		#-----------------------------------------------------------------------------------------------

		//==================================================================
		//	Set controller, method and arguments
		//==================================================================
		$controller = !empty($splits[0]) ? $splits[0] : 'index';

		#Debugging of $controller content
		$debugString .= "Echoa ut \$controller som blir \$splits[0] eller index: " . 
						$controller . "<br><br>\n";
		#---------------------------------------------------------------------------

		/*	Attempt of IF-Statement for the above code (for own personal understanding)
		-------------------------------------------------------------------------------
		if(!empty($splits[0]))
		{
			$controller = $splits[0];

		}else
		{
			$controller = 'index';
		}
		*/

		$method = !empty($splits[1]) ? $splits[1] : 'index';

		#Debugging of $method content
		$debugString .= "Echoa ut \$method som blir tilldelad \$splits[1] eller index: " . $method . "<br><br>\n";
		#---------------------------------------------------------------------------------------------------------

		$arguments = $splits;

		#Debugging of $arguments Before* unsetting of values
		$debugString .= "Echoa ut \$arguments innan [0] &amp; [1] unsettas: " . 
						print_r($arguments, true) . "<br><br>\n";
		#----------------------------------------------------------------------

		unset($arguments[0], $arguments[1]); //remove controller & method part from argument list

		#Debugging of $arguments After* unsetting of values
		$debugString .= "Echoa ut \$arguments efter att [0] &amp; [1] unsettades - visa vad som finns kvar: " . 
						print_r($arguments, true) . "<br><br>\n";
		#------------------------------------------------------------------------------------------------------

		//==================================================================
		//	Prepare to create current_url and base_url
		//==================================================================
		$currentUrl = $this->GetCurrentUrl();
		$parts		= parse_url($currentUrl);
		$baseUrl 	= !empty($baseUrl) ? $baseUrl : "{$parts['scheme']}://{$parts['host']}" .
					  (isset($parts['port']) ? ":{$parts['port']}" : '') . rtrim(dirname($scriptName), '/');

		//	Store it
		$this->base_url		= rtrim($baseUrl, '/') . '/';
		$this->current_url	= $currentUrl;
		
		$this->request_uri = $_SERVER['REQUEST_URI'];
		$this->script_name = $_SERVER['SCRIPT_NAME'];
		$this->query       = $query;
		$this->splits      = $splits;
		$this->controller  = $controller;
		$this->method      = $method;
		$this->arguments   = $arguments;
	}
}