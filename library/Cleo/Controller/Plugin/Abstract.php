<?php

/**
 * Ma librairie
 * 
 * @category Cleo
 * @package  Cleo_Controller
 * @desc Front controller plugin : checks user authentication
 * @version 1.0 2011-02-15
 */

/**
 * @category Cleo
 * @package  Cleo_Controller
 * @desc Front controller plugin : checks user authentication
 * @version 1.0 2011-02-15
 */
class Cleo_Controller_Plugin_Abstract extends Zend_Controller_Plugin_Abstract
{    

    /**
     * Returns application main config object
     * 
     * @access protected
     * @uses Zend_Controller_Front
     * @return Zend_Config
     */
    protected function _getConfig()
    {
        $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $configArray = $bootstrap->getOptions();
        return $config = new Zend_Config($configArray);
    }
    
    /**
     * Returns frontcore cache object
     * 
     * @return Zend_Cache
     */
    public function getCache()
    {
        return Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('cachemanager')->getCache( 'frontcore' );
    }
    
   
}