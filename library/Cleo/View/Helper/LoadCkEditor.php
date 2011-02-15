<?php
/**
 * CLEO Consulting
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
 * @package    Application_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2009 Jean-Baptiste MONIN - CLEO Consulting
 * @version    $Id: LoadCkEditor.php 7078 2009-11-06 14:29:33Z jb $
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_View_Helper_Abstract.php */
require_once 'Zend/View/Helper/Abstract.php';

class Cleo_View_Helper_LoadCkEditor extends Zend_View_Helper_Abstract
{

   
    public function __construct()
    {
        $session = new Zend_Session_Namespace('ckAuth');
        $session->inAdminSession = true;
    }

    /**
     * Adds CkEditor JS Code to headScript stack
     *
     * @return void
     */
    public function loadCkEditor( $textAreaId )
    {   
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->view->headScript()->appendFile(URL_MAIN_ABS . 'js/ckeditor/ckeditor.js', $type = 'text/javascript');
        $viewRenderer->view->headScript()->appendFile(URL_MAIN_ABS . 'js/ckeditor/adapters/jquery.js', $type = 'text/javascript');
        //$viewRenderer->view->headScript()->appendFile(URL_MAIN_ABS . 'js/ckfinder/ckfinder.js', $type = 'text/javascript');
		$script = <<<SCRIPT
		$(document).ready( function(){
			var config = null;
			$('#{$textAreaId}').ckeditor( config );
			}
		);

SCRIPT;

		$viewRenderer->view->headScript()->appendScript( $script );

   }

}
