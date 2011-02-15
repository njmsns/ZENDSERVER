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
 * @package    Cleo_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2009 Jean-Baptiste MONIN - CLEO Consulting
 * @version    $Id: printBreadcrumbs.php 7078 2009-11-06 14:29:33Z jb $
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_View_Helper_Abstract.php */
require_once 'Zend/View/Helper/Abstract.php';

class Cleo_View_Helper_Abstract extends Zend_View_Helper_Abstract
{

    /**
     * Accesses config param
     *
     * @return Zend_Config Object
     */
    protected function _getConfig()
    {   
        return Zend_Controller_Front::getInstance()->getParam('config'); 
    }

}
