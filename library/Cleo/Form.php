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
 * @package    Cleo_Form
 * @subpackage Form
 * @copyright  2010 Jean-Baptiste MONIN - CLEO Consulting
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Form.php 03 2010-06-10 12:00:00Z jb $
 */
/** Zend_View_Helper_Abstract.php */
require_once 'Zend/Form.php';

class Cleo_Form extends Zend_Form
{
    /**
    * Constructor
    *
    * @param  mixed $options
    * @return void
    */
    public function __construct($options = null)
    {
        parent::__construct($options);
        
    }
    
    /**
    * Zend_Config object accessor
    *
    * @return Zend_Config
    */
    protected function _getConfig()
    {
        return Zend_Controller_Front::getInstance()->getParam('config');
    }
    
}
