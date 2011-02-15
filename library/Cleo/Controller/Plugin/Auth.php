<?php
/**
 * Ma librairie
 * 
 * @category Cleo
 * @package  Cleo_Controller
 * @desc Front controller plugin : checks user authentication
 * @version 1.0 2011-02-15
 */

/**
 * @category Cleo
 * @package  Cleo_Controller
 * @desc Front controller plugin : checks user authentication
 * @version 1.0 2011-02-15
 */
class Cleo_Controller_Plugin_Auth extends Cleo_Controller_Plugin_Abstract
{

	/* (non-PHPdoc)
	 * @see Zend_Controller_Plugin_Abstract::routeStartup()
	 */
	public function routeStartup()
	{
		
	}
	
	/* (non-PHPdoc)
	 * @see Zend_Controller_Plugin_Abstract::routeShutdown()
	 */
	public function routeShutdown(Zend_Controller_Request_Abstract $request)
	{
		if( !Zend_Auth::getInstance()->hasIdentity() ){
			$request->setModuleName( 'User' )
					->setControllerName( 'index' )
					->setActionName( 'connect' )
					->setDispatched( true );
		}
	}
	
	/* (non-PHPdoc)
	 * @see Zend_Controller_Plugin_Abstract::dispatchLoopStartup()
	 */
	public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
	{
		
	}
	
	/* (non-PHPdoc)
	 * @see Zend_Controller_Plugin_Abstract::preDispatch()
	 */
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
	
	}
	
	/* (non-PHPdoc)
	 * @see Zend_Controller_Plugin_Abstract::postDispatch()
	 */
	public function postDispatch(Zend_Controller_Request_Abstract $request)
	{

	}
	
	/* (non-PHPdoc)
	 * @see Zend_Controller_Plugin_Abstract::dispatchLoopShutdown()
	 */
	public function dispatchLoopShutdown()
	{
					
	}

}