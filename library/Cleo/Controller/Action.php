<?php 
/**
 * Ma librairie
 * 
 * @category Cleo
 * @package  Cleo_Controller
 * @desc Zend_Exception overload
 * @version 1.0 2011-02-15
 */

/**
 * @see Zend/Controller/Action.php
 */
require_once 'Zend/Controller/Action.php';
/**
 * @category Cleo
 * @package  Cleo_Controller
 * @desc Zend_Exception overload
 * @version 1.0 2011-02-15
 */
class Cleo_Controller_Action extends Zend_Controller_Action
{

    /**
     * @param string $method method named trapped by __call
     * @param array  $args arguments passed to trapped method
     * @see Zend_Controller_Action::__call()
     * @throws Zend_Controller_Action_Exception
     * @return mixed
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