<?php
/**
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 * 
 * @category   Cleo
 * @package    Cleo_Application_Resource
 * @subpackage View
 * @copyright  2010 Jean-Baptiste MONIN - CLEO Consulting
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: View.php 03 2010-06-31712:00:00Z jb $
 */
 
 /** Zend_Application_Resource_ResourceAbstract.php */
require_once 'Zend/Application/Resource/ResourceAbstract.php';

class Cleo_Application_Resource_View extends Zend_Application_Resource_ResourceAbstract
{
    protected $_localOptions;
    protected $_view;
 
	
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

	protected function _setupCss()
	{
        $this->_view->headLink()->appendStylesheet( '/css/style.css' );
        $this->_view->headLink()->appendStylesheet( '/css/print.css' , 'print');
	}
	
	protected function _setupJs()
	{
		$this->_view->headScript()->appendFile('/js/jquery-1.4.2.min.js', $type = 'text/javascript');
	}
	
	protected function _setupHeadOptions()
	{
		// Défini le charset
		$this->_view->headMeta()->setHttpEquiv( 'Content-Type', 'text/html; charset=' . $this->_localOptions['encoding'] );
		// Défini le doctype
		$this->_view->doctype($this->_localOptions['doctype']);
	}


}