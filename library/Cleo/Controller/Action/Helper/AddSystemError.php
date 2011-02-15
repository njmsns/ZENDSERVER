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
 * @subpackage AddSystemError
 * @copyright  2010 Jean-Baptiste MONIN - CLEO Consulting
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: AddSystemError.php 03 2010-06-10 jb $
 */
 
 /** Cleo_Controller_Action_Helper_Abstract.php */
require_once 'Cleo/Controller/Action/Helper/Abstract.php';

class Cleo_Controller_Action_Helper_AddSystemError extends Cleo_Controller_Action_Helper_Abstract
{
    /**
     * Session namespace
     * @var string
     */
    protected $_sessionNamespace = 'Cleo_System_Messages';
    /**
     * Stores a system message in session
     *
     * @param string $message
     * @return void
     */
    public function direct( $message, $httpStatusCode = 404 )
    {
        // messages persistance layer stored in session
        $messages       = new Zend_Session_Namespace($this->_sessionNamespace);
        // in "error" container as an array (queue)
        $messageBuffer  = $messages->error;
        if ( !is_array( $messageBuffer ) ) {
            $messageBuffer = array();
        }
        $messageBuffer[]        = $message;
        $messages->error        = $messageBuffer;
        $messages->reponseCode  = $httpStatusCode;
      
    }
}