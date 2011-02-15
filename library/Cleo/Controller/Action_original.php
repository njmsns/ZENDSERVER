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
 * @package    Cleo_Controller
 * @subpackage Action
 * @copyright  2010 Jean-Baptiste MONIN - CLEO Consulting
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Action.php 03 2010-03-30 jb $
 */
 
 /** Zend_View_Helper_Abstract.php */
require_once 'Zend/Controller/Action.php';

class Cleo_Controller_Action extends Zend_Controller_Action
{

    /**
     * Surcharge : intercepte les appels aux méthodes de classe non définies
     * Tente d'appeler le helper d'action du meme nom
     *
     * @param  string $method
     * @param  array  $args
     * @return void
     * @throws Zend_Controller_Action_Exception si une méthode est indéfinie
     */
    public function __call( $method, $args)
    {
        // If calls concerns not implemented controller action
        if ( strpos( $method, 'Action' )){
            throw new Zend_Controller_Action_Exception('L\'action "' . $method . '" n\'est pas implémentée.');
        }
        
        try{
            return $this->_helper->$method( implode( ',', $args ) );
       } catch( Zend_Controller_Action_Helper_Exception $e ){
            throw new Zend_Controller_Action_Exception('L\'aide d\'action "' . $method . '" n\'est pas implémentée.');
       }
    }
    
}