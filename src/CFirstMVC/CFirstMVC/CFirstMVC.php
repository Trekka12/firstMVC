<?php
/**
*	Main class for FirstMVC, holds everything.
*
*	@package FirstMVC_Core
*/
class CFirstMVC implements ISingleton {
	private static $instance = null;

	/**
	 *	Singleton pattern. Get the instance of the latest created object or create a new one.
	 *	@return CFirstMVC The instance of this class.
	 */
	public static function Instance() {
		if(self::$instance == null) 
		{
			self::$instance = new CFirstMVC();
		}
		return self::$instance;
	}

	/**
	 *	Constructor
	 */
	protected function __construct() {
		//include the site specific config.php and create a reference to $firstMVC to be used by config.php
		$firstMVC = &$this;
		require(FIRSTMVC_SITE_PATH . '/config.php');
	}

	/**
	 *	Frontcontroller, check url and route to controllers.
	 */
	public function FrontControllerRoute() {
		$this->data['debug']  = "REQUEST_URI - {$_SERVER['REQUEST_URI']}\n";
		$this->data['debug'] .= "SCRIPT_NAME - {$_SERVER['SCRIPT_NAME']}\n";
	}

	/**
	 *	Theme Engine Render, renders the views using the selected theme.
	 */
	public function ThemeEngineRender() {
		echo "<h1> I am CFirstMVC::ThemeEngineRender</h1><p>You are most welcome. Nothing to render at the moment</p>";
		echo "<pre>", print_r($this->data, true) . "</pre>";
	}
}