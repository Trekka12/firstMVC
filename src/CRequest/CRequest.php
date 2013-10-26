<?php
/**
*	Parse the request and identify controller, method and arguments
*
*	@package FirstMVC_Core
*/
class CRequest {

	/**
	 *	Parse the current url request and divide it in controller, method and arguments.
	 *	
	 *	Calculates the base_url of the installation. Stores all useful details in $this.
	 *
	 *	@param $baseUrl string - use this as a hardcoded baseurl.
	 */
	public function Init($baseUrl = null) {
		//For debug-information
		$debugString = "";
		//==========================================================================
		//	Take the current url and divide it in controller, method and arguments
		//==========================================================================
		$scriptName = $_SERVER['SCRIPT_NAME'];
		$requestUri = $_SERVER['REQUEST_URI'];
		
		//	Check if url is in format controller/method/arg1/arg2/arg3 by comparing requestUri with scriptName
		//	if they are match => declare $scriptPart to the directory name of $scriptName.
		if(substr_compare($requestUri, $scriptName, 0, strlen($scriptName)))
		{
			$scriptPart = dirname($scriptName);
		}

		$query = trim(substr($requestUri, strlen(rtrim($scriptPart, '/'))), '/');

		#Debugging of $query - old code:
		$debugString .= "Echoa ut \$queryn: " . $query . "<br><br>\n";
		#-------------------------------------------------------------

		//	Check if this looks like a querystring approach link 
		//	(e.g. (e.g. = latin for exampli gratia => english translation = "For example" (for own personal (finally :P) understanding)
		//	and i.e. = Latin for id est => english translation = "that is") 'index.php?q=')
		if(substr($query, 0, 1) === '?' && isset($_GET['q']))
		{
			$query = trim($_GET['q']);
		}

		$splits = explode('/', $query);

		#Debugging of $splits content - old code:
		$debugString .= "Echoa ut \$splits och dess innehåll: " . print_r($splits, true) . "<br><br>\n";
		#-----------------------------------------------------------------------------------------------

		/*
			Test code customized by self to try and solve issue with index.php/controller/method/arg1/arg2/arg3 links, as well as
			index.php?q=/controller/method/arg1/arg2/arg3
			- Note to self: would be a statical solution... => meaning if q= were to be changed to f= or p= then would not work.

			if(substr($länken, 0, 9) == "index.php")
			{
				
					Gör då som så att strippa länken/$queryn av sin index.php början, och returnera sedan $query som blir över. 
				
			}elseif(substr($länken, 0, 12) == "index.php?q=")
			{
				
					Gör då som så att strippa bort de 12 första tecknen med substr, och returnera återstoden av länken som $query.
				
			}
		*/

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

		$this->request_uri = $requestUri;
		$this->script_name = $scriptName;
		$this->query       = $query;
		$this->splits      = $splits;
		$this->controller  = $controller;
		$this->method      = $method;
		$this->arguments   = $arguments;
	}

	/**
     *	Get the url to the current page. 
     */
	public function GetCurrentUrl() {
	    $url = "http";
	    $url .= (@$_SERVER["HTTPS"] == "on") ? 's' : '';
	    $url .= "://";
	    $serverPort = ($_SERVER["SERVER_PORT"] == "80") ? '' :
	    (($_SERVER["SERVER_PORT"] == 443 && @$_SERVER["HTTPS"] == "on") ? '' : ":{$_SERVER['SERVER_PORT']}");
	    $url .= $_SERVER["SERVER_NAME"] . $serverPort . htmlspecialchars($_SERVER["REQUEST_URI"]);
	    return $url;
  }

  /**
   *	Create a url in the way it should be created.
   */
  public function CreateUrl($url = null) {
  	$prepend = $this->base_url;
  	if($this->cleanUrl)
  	{
  		;

  	}elseif($this->querystringUrl)
  	{
  		$prepend .= 'index.php?q=';
  	
  	}else
  	{
  		$prepend .= 'index.php/';
  	}
  	
  	return $prepend . rtrim($url, '/');
  }
}