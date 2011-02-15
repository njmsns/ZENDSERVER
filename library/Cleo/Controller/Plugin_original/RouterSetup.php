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
 * @package    Cleo_Controller_Plugin
 * @subpackage RouterSetup
 * @copyright  Copyright (c) 2005-2009 Jean-Baptiste MONIN / CLEO CONSULTING
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: RouterSetup.php 01 2010-04-01 12:00:00Z jb $
 */
 
 /** Zend_Controller_Plugin_Abstract.php */
require_once 'Cleo/Controller/Plugin/Abstract.php';

class Cleo_Controller_Plugin_RouterSetup extends Cleo_Controller_Plugin_Abstract
{    
    
   public function routeStartup()
    {
            // Adds routes defined in routes.ini
            $frontController    = Zend_Controller_Front::getInstance();
            $router             = $frontController->getRouter();
            $config             = new Zend_Config_Ini( ROOT_PATH . DS . 'etc' . DS . 'routes.ini', 'production');
            $router->addConfig($config, 'routes');
     
    }
    
    
    
    
   
    
}