<?php
/**
*	Standard controller layout
*
*	@package FirstMVC_Core
*/
class CCIndex implements IController {

	/**
	 *	Implementing interface IController. All controllers must have an index action.
	 */
	public function Index() {
		global $firstMVC;
		$firstMVC->data['title'] = "The Index Controller";
	}
}