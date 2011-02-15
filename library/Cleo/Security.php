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
 * @package    Cleo_Security
 * @copyright  Copyright (c) 2005-2009 Jean-Baptiste MONIN / CLEO CONSULTING
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Security.php 01 2010-04-01 12:00:00Z jb $
 */

class Cleo_Security
{
     /**
     * Application environment
     *
     * @var string
     */
    protected $_environment;
    
    /**
     * Options for Application_Security
     *
     * @var array
     */
    protected $_options = array();
    
    /**
     * Activated actions queue
     *
     * @var array
     */
    protected $_actions = array( 
                                 'checkip'              => false, 
                                 'filterCookie'         => false,  
                                 'filterPost'           => false,  
                                 'filterGet'            => false, 
                                 '_filterZendRequest'    => false  
                               );
    
    /**
     * Zend_Log object
     *
     * @var array
     */
    protected $_logger;
    
    /**
     * Flattened (lowercase) option keys
     *
     * @var array
     */
    protected $_optionKeys = array();
    
    /**
     * Filter rules
     *
     * @var array
     */
    protected $_filterRules = array();
    
    /**
     * List of allowed IP addresses
     *
     * @var array
     */
    protected $_ipAllowed = array();
    
    /**
     * List of denied IP addresses
     *
     * @var array
     */
    protected $_ipDenied = array();
	
	
	
     /**
     * class constructor
     *
     * @var string $environment ( development | statging | testing | production )
     * @var string|Zend_Config Object $options
     * @var Zend_Controller_Request_Abstract Object $request
     * @return void
     */   
    public function __construct( $environment, $options = null, Zend_Controller_Request_Abstract $request ) 
    {
        $this->_environment = (string) $environment;
        $this->_request     = $request;
        
        if (null !== $options) {
            if (is_string($options)) {
                $options = $this->_loadConfig($options);
            } elseif ($options instanceof Zend_Config) {
                $options = $options->toArray();
            } elseif (!is_array($options)) {
                throw new Application_Exception('Invalid options provided; must be location of config file, a config object, or an array');
            }

            $this->_setOptions($options);
            $this->_executeActions();
        }
    }

   
     /**
     * Main public method
     *
     * Proxy to protected _executeAction method
     * @return void
     */   
    public function run() 
    {
        $this->_executeActions();
    }
    
    /**
     * Sets application options
     *
     * @param  array $options
     * @throws Application_Exception When missing config params 
     * @return Application_Security
     */
    protected function _setOptions(array $options)
    {

        $this->_options = $options;
        $this->_actions = array();
        
        $options = array_change_key_case($options, CASE_LOWER);
        $this->_optionKeys = array_keys($options);
        
        if (!in_array('report', $this->_optionKeys )) {
            throw new Application_exception( 'Invalid configuration file : report params not found' );
        }
        
        if (!in_array('filters', $this->_optionKeys )) {
            throw new Application_exception( 'Invalid configuration file : filters params not found' );
        }

        if (!empty( $options['report']['logFile'])) {
            $this->_setLogger($options['report']['logFile']);
        }
        
        if (!empty( $options['filters']['ip'])) {
            if (!empty( $options['filters']['ip']['allow'])) {
                $this->setIpAllowed($options['filters']['ip']['allow']);
            }
            
            if (!empty( $options['filters']['ip']['deny'])) {
                foreach( $options['filters']['ip']['deny'] as $ip ){
                    $this->setIpDenied($ip);
                }
            }
            $this->_actions['checkip'] = true;
        }
        
        if (!empty( $options['filters']['server'])) {
            if (!empty( $options['filters']['server']['dedibox'])) {
                if ( $options['filters']['server']['dedibox'] ){
                    $this->setIpDenied( array( 'starts' => '88.191.0.0', 'ends' => '88.191.255.255', 'name' => 'DEDIBOX' ));
                    $this->_actions['checkip'] = true;
                }
            }
            
            if (!empty( $options['filters']['server']['digicube'])) {
                if ( $options['filters']['server']['digicube'] ){
                    $this->setIpDenied( array( 'starts' => '95.130.0.0', 'ends' => '95.130.255.255', 'name' => 'DIGICUBE' ));
                    $this->_actions['checkip'] = true;
                }
            }
            
            if (!empty( $options['filters']['server']['ovh'])) {
                if ( $options['filters']['server']['ovh'] ){
                    $this->setIpDenied( array( 'starts' => '87.98.0.0', 'ends' => '87.98.255.255', 'name' => 'OVH' ))
                         ->setIpDenied( array( 'starts' => '91.121.0.0', 'ends' => '91.121.255.255', 'name' => 'OVH' ))
                         ->setIpDenied( array( 'starts' => '94.23.0.0', 'ends' => '94.23.255.255', 'name' => 'OVH' ))
                         ->setIpDenied( array( 'starts' => '213.186.0.0', 'ends' => '213.186.255.255', 'name' => 'OVH' ))
                         ->setIpDenied( array( 'starts' => '213.251.0.0', 'ends' => '213.251.255.255', 'name' => 'OVH' ));
                    $this->_actions['checkip'] = true;
                }
            }
            
            if (!empty( $options['filters']['server']['reserved'])) {
                if ( $options['filters']['server']['reserved'] ){
                    $this->setIpDenied( array( 'starts' => '0.0.0.0',   'ends' => '2.255.255.255',   'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '5.0.0.0',   'ends' => '5.255.255.255',   'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '10.0.0.0',  'ends' => '10.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '14.0.0.0',  'ends' => '14.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '23.0.0.0',  'ends' => '23.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '27.0.0.0',  'ends' => '27.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '31.0.0.0',  'ends' => '31.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '36.0.0.0',  'ends' => '37.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '39.0.0.0',  'ends' => '39.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '42.0.0.0',  'ends' => '42.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '46.0.0.0',  'ends' => '46.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '49.0.0.0',  'ends' => '49.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '50.0.0.0',  'ends' => '50.255.255.255',  'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '100.0.0.0', 'ends' => '107.255.255.255', 'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '114.0.0.0', 'ends' => '114.255.255.255', 'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '172.0.0.0', 'ends' => '172.255.255.255', 'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '176.0.0.0', 'ends' => '177.255.255.255', 'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '179.0.0.0', 'ends' => '179.255.255.255', 'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '181.0.0.0', 'ends' => '181.255.255.255', 'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '185.0.0.0', 'ends' => '185.255.255.255', 'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '192.0.0.0', 'ends' => '192.255.255.255', 'name' => 'RESERVED' ))
                         ->setIpDenied( array( 'starts' => '223.0.0.0', 'ends' => '224.255.255.255', 'name' => 'RESERVED' ));
                    $this->_actions['checkip'] = true;
                }
            }            
            
            if (!empty( $options['filters']['server']['spam'])) {
                if ( $options['filters']['server']['spam'] ){
                    $this->setIpDenied( array( 'starts' => '24.0.0.0',  'ends' => '24.255.255.255',   'name' => 'SPAM' ))
                         ->setIpDenied( array( 'starts' => '186.0.0.0', 'ends' => '186.255.255.255',  'name' => 'SPAM' ))
                         ->setIpDenied( array( 'starts' => '189.0.0.0', 'ends' => '190.255.255.255',  'name' => 'SPAM' ))
                         ->setIpDenied( array( 'starts' => '200.0.0.0', 'ends' => '202.255.255.255',  'name' => 'SPAM' ))
                         ->setIpDenied( array( 'starts' => '209.0.0.0', 'ends' => '209.255.255.255',  'name' => 'SPAM' ))
                         ->setIpDenied( array( 'starts' => '212.0.0.0', 'ends' => '213.255.255.255',  'name' => 'SPAM' ))
                         ->setIpDenied( array( 'starts' => '217.0.0.0', 'ends' => '217.255.255.255',  'name' => 'SPAM' ))
                         ->setIpDenied( array( 'starts' => '222.0.0.0', 'ends' => '222.255.255.255',  'name' => 'SPAM' ));
                    $this->_actions['checkip'] = true;
                }
            }
        }   
        $this->_filterRules = array( 'applet', 
                                    'base', 
                                    'bgsound', 
                                    'blink', 
                                    'embed', 
                                    'expression', 
                                    'frame', 
                                    'javascript', 
                                    'layer', 
                                    'link', 
                                    'meta', 
                                    'object', 
                                    'onabort', 
                                    'onactivate', 
                                    'onafterprint', 
                                    'onafterupdate', 
                                    'onbeforeactivate', 
                                    'onbeforecopy', 
                                    'onbeforecut', 
                                    'onbeforedeactivate', 
                                    'onbeforeeditfocus', 
                                    'onbeforepaste', 
                                    'onbeforeprint', 
                                    'onbeforeunload', 
                                    'onbeforeupdate', 
                                    'onblur', 
                                    'onbounce', 
                                    'oncellchange', 
                                    'onchange', 
                                    'onclick', 
                                    'oncontextmenu', 
                                    'oncontrolselect', 
                                    'oncopy', 
                                    'oncut', 
                                    'ondataavailable', 
                                    'ondatasetchanged', 
                                    'ondatasetcomplete', 
                                    'ondblclick', 
                                    'ondeactivate', 
                                    'ondrag', 
                                    'ondragend', 
                                    'ondragenter', 
                                    'ondragleave', 
                                    'ondragover', 
                                    'ondragstart', 
                                    'ondrop', 
                                    'onerror', 
                                    'onerrorupdate', 
                                    'onfilterchange', 
                                    'onfinish', 
                                    'onfocus', 
                                    'onfocusin', 
                                    'onfocusout', 
                                    'onhelp', 
                                    'onkeydown', 
                                    'onkeypress', 
                                    'onkeyup', 
                                    'onlayoutcomplete', 
                                    'onload', 
                                    'onlosecapture', 
                                    'onmousedown', 
                                    'onmouseenter', 
                                    'onmouseleave', 
                                    'onmousemove', 
                                    'onmouseout', 
                                    'onmouseover', 
                                    'onmouseup', 
                                    'onmousewheel', 
                                    'onmove', 
                                    'onmoveend', 
                                    'onmovestart', 
                                    'onpaste', 
                                    'onpropertychange', 
                                    'onreadystatechange', 
                                    'onreset', 'onresize', 
                                    'onresizeend', 
                                    'onresizestart', 
                                    'onrowenter', 
                                    'onrowexit', 
                                    'onrowsdelete', 
                                    'onrowsinserted', 
                                    'onscroll', 
                                    'onselect', 
                                    'onselectionchange', 
                                    'onselectstart', 
                                    'onstart', 
                                    'onstop', 
                                    'onsubmit', 
                                    'onunload', 
                                    'script', 
                                    'style', 
                                    'title', 
                                    'union', 
                                    'select', 
                                    '#', 
                                    '--', 
                                    'vbscript', 
                                    'xml'
                                );
                                
            if (!empty( $options['filters']['params']['cookie'])) {
                if ( $options['filters']['params']['cookie'] ){
                    $this->_actions['filterCookie'] = true;
                }
            }
            
            if (!empty( $options['filters']['params']['post'])) {
                if ( $options['filters']['params']['post'] ){
                    $this->_actions['filterPost'] = true;
                }
            }
            
            if (!empty( $options['filters']['params']['get'])) {
                if ( $options['filters']['params']['get'] ){
                    $this->_actions['filterGet'] = true;
                }
            }
            
            if (!empty( $options['filters']['params']['zend'])) {
                if ( $options['filters']['params']['get'] ){
                    $this->_actions['filterZendRequest'] = true;
                }
            }
		
        return $this;
    }
    
    /**
     * Runs previously activated actions
     *
     * @return void
     */
    protected function _executeActions()
    {

        foreach( $this->_actions as $action => $execute ) {
            if( $execute ){
                $action = '_' . $action;
                $this->$action();
            }
        }
    }
    
    /**
     * Retrieve application options (for caching)
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * Is an option present?
     *
     * @param  string $key
     * @return bool
     */
    public function hasOption($key)
    {
        return in_array(strtolower($key), $this->_optionKeys);
    }
    
    /**
     * Retrieve current environment
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->_environment;
    }    
    
    /**
     * Stores allowed ips in an array
     *
     * @param  array $ips
     * @return Application_Security
     */
    public function setIpAllowed(array $ips)
    {
        $this->_ipAllowed = $ips;
        return $this;
    }
    
    /**
     * Retrieves allowed ips array
     *
     * @return array
     */
    public function getIpAllowed()
    {   
        return $this->_ipAllowed;
    }
    
    /**
     * Stores denied ips in an array
     *
     * @param  array $ips
     * @return Application_Security
     */
    public function setIpDenied($ip)
    {
        if ( !is_array($this->getIpDenied()) ){
            $this->_ipDenied = $ip;
        }
        else {
            $this->_ipDenied[] = $ip;
        }
        return $this;
    }
    
    /**
     * Retrieves denied ips array
     *
     * @return array
     */
    public function getIpDenied()
    {   
        return $this->_ipDenied;
    }
    
    /**
     * Parses and filters $_COOKIE entries
     *
     * @return void
     */
    protected function _filterCookie()
    {
        foreach( $_COOKIE as $param => $value ) {
			$check = str_replace($this->_filterRules, '_FILTERED_', $value);
			if( $value != $check ) {
				$this->_log( 'Filtre COOKIE activé pour la valeur ' . $value . CRLF );
				$_COOKIE[$param] = $check;
				unset( $value );
			}
		}
    }
     /**
     * Parses and filters $_POST entries
     *
     * @return void
     */
    protected function _filterPost()
    {
        foreach( $_POST as $param => $value ) {
			$check = str_replace($this->_filterRules, '_FILTERED_', $value);
			if( $value != $check ) {
				$this->_log( 'Filtre POST appliqué à la valeur ' . $value . CRLF );
				$_POST[$param] = $check;
				unset( $value );
			}
		}    
    }
    
    /**
     * Parses and filters $_GET entries
     *
     * @return void
     */
    protected function _filterGet()
    {
        foreach( $_GET as $param => $value ) {
			$check = str_replace($this->_filterRules, '_FILTERED_', $value);
			if( $value != $check ) {
				$this->_log( 'Filtre GET appliqué à la valeur ' . $value . CRLF );
				$_GET[$param] = $check;
				unset( $value );
			}
		}    
    }
    
    /**
     * Parses and filters $_GET entries
     *
     * @return void
     */
    protected function _filterZendRequest()
    {
        foreach( $this->_request->getParams() as $key => $value ) {
            if( $key != 'controller' && $key != 'action' && $key != 'module' ){
                foreach( $this->_filterRules as $filterRule ){
                    $check = str_replace($this->_filterRules, '_FILTERED_', $value);
                }
                if( $value != $check ) {
                    $this->_log( 'Filtre ZEND REQUEST appliqué à la valeur ' . $value . CRLF );
					$this->_request->setParam( $key, $check );
                    unset( $value );
                }
            }
		} 
    }
    
    /**
     * Checks access based on Ip address , order Deny, Allow
     *
     * @return void
     */
    protected function _checkIp()
    {
        $reject = false;
        // DENY
        if ( count( $this->getIpDenied() ) > 0 ) {
            foreach( $this->getIpDenied() as $ip ){
                // SINGLE IP
                if( !is_array( $ip ) ){
                    if ( ip2long($_SERVER['REMOTE_ADDR']) == ip2long($ip) )  {
                        $reject = true;
                        $messageType = 'deny';
                    }
                }
                // IP RANGE
                else{
                    $starts     = ip2long( $ip['starts']);
                    $ends       = ip2long( $ip['ends']);
                    $clientIp   = ip2long( $_SERVER['REMOTE_ADDR']);
                    if (  $starts <= $clientIp && $clientIp <= $ends ) {
                        $reject = true;
                        $messageType = $ip['name'];
                    }
                }
            }
        }
        // ALLOW
        if ( count( $this->getIpAllowed() ) > 0 ) {
            if ( !in_array( $_SERVER['REMOTE_ADDR'], $this->getIpAllowed() ) ){
                    $reject = true;
            }
        }
        
        // PROCESS
        if ( true === $reject ) {
            $options       = $this->getOptions();
            // $this->_request->setModuleName( 'Core' )
                           // ->setControllerName( 'Error' )
                           // ->setActionName( 'deny' );
			$this->_exitWithMessage();
        }
    }
    
    /**
     * Load configuration file of options
     *
     * @param  string $file
     * @throws Application_Exception When invalid configuration file is provided
     * @return array
     */
    protected function _loadConfig($file)
    {
        $environment = $this->getEnvironment();
        $suffix      = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        switch ($suffix) {
            case 'ini':
                $config = new Zend_Config_Ini($file, $environment);
                break;

            case 'xml':
                $config = new Zend_Config_Xml($file, $environment);
                break;

            case 'php':
            case 'inc':
                $config = include $file;
                if (!is_array($config)) {
                    throw new Zend_Application_Exception('Invalid configuration file provided; PHP file does not return array value');
                }
                return $config;
                break;

            default:
                throw new Zend_Application_Exception('Invalid configuration file provided; unknown config type');
        }
        return $config->toArray();
    }
    
    /**
     * Instanciates and configures Logger
     *
     * @param  array $settings
     * @return Application_Security
     */
    protected function _setLogger($file)
    {
        $writer        = new Zend_Log_Writer_Stream( $file );
        $this->_logger = new Zend_Log($writer);

        return $this;
    }
    
    /**
     * Retrieves logger
     *
     * @return Zend_Log
     */
    protected function _getLogger()
    {   
        if ( $this->_logger instanceof Zend_Log ){
            return $this->_logger;
        }
       return null;
    }
    
    /**
     * adds an entry in logfile
     *
     * @return Application_Security
     */
    protected function _log( $message )
    {   
        if ( null !== $this->_getLogger() ){
            $this->_getLogger()->err( $message );
        }
        return $this;
    }
	
	protected function _exitWithMessage()
	{
		echo ' <html><head></head><body><style><!--
                body {
                    margin: 0px;
                }

                #content {
                    border: 1px solid #EFECBA;
                    width: 300px;
                    height: 150px;
                    background-color: #FBFAE7;
                    padding:20px;
                    top: 30%;
                    left: 50%;
                    position: absolute;
                }

                #container  {
                    width: 100%;
                    height: 100%;
                    font: 11px tahoma;
                    position: absolute;
                    top: -75px;
                    left: -150px;
                }
                
                code{
                    color: red;
                }
                --></style>
                <div id="container">
                <div id="content"><b>Erreur lors de l\'initialisation de l\'application...</b><br /><br /> Les règles de sécurité en vigueur ne vous permettent pas d\'accéder à l\'application.<br />
				<br />Votre adresse IP : ' . $_SERVER['REMOTE_ADDR'] . ' a été enregistrée.';
            echo '</div>
                </div></body></html>';
            exit(0);
	}
    
}