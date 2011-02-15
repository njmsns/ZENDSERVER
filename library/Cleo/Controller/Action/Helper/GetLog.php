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
 * @package    Cleo_Controller_Action_Helper
 * @subpackage GetLog
 * @copyright  2010 Jean-Baptiste MONIN - CLEO Consulting
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: GetLog.php 03 2010-06-10 12:00:00Z jb $
 */
 
 /** Cleo_Controller_Action_Helper_Abstract.php */
require_once 'Cleo/Controller/Action/Helper/Abstract.php';

class Cleo_Controller_Action_Helper_GetLog extends Cleo_Controller_Action_Helper_Abstract
{

    /**
     * accesses Zend_Log ressource
     *
     * @return Zend_Log
     */
    public function direct( )
    {
        return $this->_getResource('log');
    }
}