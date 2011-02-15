<?php

class Cleo_Controller_Plugin_Auth extends Cleo_Controller_Plugin_Abstract
{

	public function routeStartup()
	{
		
	}
	
	public function routeShutdown(Zend_Controller_Request_Abstract $request)
	{
		if( !Zend_Auth::getInstance()->hasIdentity() ){
			$request->setModuleName( 'User' )
					->setControllerName( 'index' )
					->setActionName( 'connect' )
					->setDispatched( true );
		}
	}
	
	public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
	{
		
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
	
	}
	
	public function postDispatch(Zend_Controller_Request_Abstract $request)
	{

	}
	
	public function dispatchLoopShutdown()
	{
					
	}

}