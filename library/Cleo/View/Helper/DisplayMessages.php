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
 * @package    Cleo_View_Helper
 * @subpackage DisplayMessages
 * @copyright  2010 Jean-Baptiste MONIN - CLEO Consulting
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: DisplayMessages.php 03 2010-06-10 12:00:00Z jb $
 */
/** Zend_View_Helper_Abstract.php */
require_once 'Zend/View/Helper/Abstract.php';

class Cleo_View_Helper_DisplayMessages extends Zend_View_Helper_Abstract
{

    /**
     * Session namespace
     * @var string
     */
    protected $_sessionNamespace = 'Cleo_System_Messages';
    
  /**
     * displayMessages
     *
     * @return string
     */
    function displayMessages()
    {
        // retrieves stored system messages
        $messages = new Zend_Session_Namespace($this->_sessionNamespace);
        
        // for each type of messages, display if not empty
        if ( is_array($messages->success) && 0 != count($messages->success) ) {
            print '<p class="success">';
            foreach( $messages->success as $message ){
                print $message . '<br />';
            }
            print '</p>';
            $messages->success = array();
        }
        if (  is_array($messages->warning) && 0 != count($messages->warning) ) {
            print '<p class="warning">';
            foreach( $messages->warning as $message ){
                print $message . '<br />';
            }
            print '</p>';
            $messages->warning = array();
        }
        if ( is_array($messages->error) && 0 != count($messages->error) ) {
            print '<p class="error">';
            foreach( $messages->error as $message ){
                print $message . '<br />';
            }
            print '</p>';
            $messages->error = array();
        }

    }
}