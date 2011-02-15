<?php
/**
 * Ma librairie
 * 
 * @category Cleo
 * @package  Cleo_Application
 * @desc Zend_Application_Resource_View overload
 * @version 0.9 2011-02-15
 */

/**
 * @see Zend/Application/Resource/ResourceAbstract.php
 */
require_once 'Zend/Application/Resource/ResourceAbstract.php';

/**
 * @category Cleo
 * @package  Cleo_Application
 * @desc Zend_Application_Resource_View overload
 * @version 0.9 2011-02-15
 */
class Cleo_Application_Resource_View extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * View options (from config file)
     * @var array
     */
    protected $_localOptions;
    /**
     * View object
     * @var Cleo_View
     */
    protected $_view;
 
	
    /**
     * Class pseudo-constructor
     * 
     * Example of use
     * @see Zend_Application_Resource_Resource::init()
     * @uses Cleo_View
     * @return Cleo_View
     */
    public function init()
    {
	
		$this->_localOptions = $this->getOptions();

        # Returns view so bootstrap will store it in the registry
        if (null === $this->_view) {
            $this->_view = new Cleo_View($this->_options);
        }
		
		$this->_setupCss();
		$this->_setupJs();
		$this->_setupHeadOptions();
		
		$viewRenderer =
                Zend_Controller_Action_HelperBroker::getStaticHelper(
                    'ViewRenderer'
                );
        $viewRenderer->setView($this->_view);
		return $this->_view;
    }

	/**
	 * Loads Css in headStyle stack
	 * @return void
	 */
	protected function _setupCss()
	{
        $this->_view->headLink()->appendStylesheet( '/css/style.css' );
        $this->_view->headLink()->appendStylesheet( '/css/print.css' , 'print');
	}
	
	/**
	 * Loads Js in headScript stack
	 * @return void
	 */
	protected function _setupJs()
	{
		$this->_view->headScript()->appendFile('/js/jquery-1.4.2.min.js', $type = 'text/javascript');
	}
	
	/**
	 * Loads HTML head helpers
	 * @return void
	 */
	protected function _setupHeadOptions()
	{
		// Défini le charset
		$this->_view->headMeta()->setHttpEquiv( 'Content-Type', 'text/html; charset=' . $this->_localOptions['encoding'] );
		// Défini le doctype
		$this->_view->doctype($this->_localOptions['doctype']);
	}


}