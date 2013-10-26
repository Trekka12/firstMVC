<?php
/**
 *	Controller for development and testing purposes, helpful methods for the developer.
 *
 *	@package FirstMVC_Core
 */
class CCDeveloper implements IController {
	/**
 	 *	Implementing interface IController. All controllers must have an index action.
 	 */
	public function Index() {
		$this->Menu();
	}

	/**
	 *	Create a list of links in the supported ways.
	 */
	public function Links() {
		$this->Menu();
		
		$firstMVC = CFirstMVC::Instance();

		$url = 'developer/links';
		$current = $firstMVC->request->CreateUrl($url);

		$firstMVC->request->cleanUrl = false;
		$firstMVC->request->querystringUrl = false;
		$default = $firstMVC->request->CreateUrl($url);

		$firstMVC->request->cleanUrl = true;
		$clean = $firstMVC->request->CreateUrl($url);

		$firstMVC->request->cleanUrl = false;
		$firstMVC->request->querystringUrl = true;
		$querystring = $firstMVC->request->CreateUrl($url);

		$firstMVC->data['main'] .= <<<EOD
		<h2>CRequest::CreateUrl()</h2>
		<p>Here is a list of urls created using above method with various settings. All links should lead to this same page.</p>
		<ul>
		<li><a href='$current'>This is the current setting</a></li>
		<li><a href='$default'>This would be the default url</a></li>
		<li><a href='$clean'>This should be a clean url</a></li>
		<li><a href='$querystring'>This should be a querystring like url</a></li>
		</ul>
		<p>Enables various and flexible url-strategy.</p>
EOD;
	}

	/**
	 *	Create a method that shows the menu, same for all methods
	 */
	private function Menu() {
		$firstMVC = CFirstMVC::Instance();
		$menu = array('developer', 'developer/index', 'developer/links');
		
		$html = null;
		foreach($menu as $value)
		{
			$html .= "<li><a href='" . $firstMVC->request->CreateUrl($value) . "'>$value</a>";
		}

		$firtMVC->data['title'] = "The Developer Controller";
		$firstMVC->data['main'] = <<<EOD
		<h1>The Developer Controller</h1>
		<p>This is what you can do for now:</p>
		<ul>
		$html
		</ul>
EOD;
	}

}