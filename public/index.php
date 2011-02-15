<?php
ini_set( 'display_errors', true ); 
ini_set( 'error_reporting', E_ALL ) ;
date_default_timezone_set('Europe/Paris');


// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define path to root directory
defined('ROOT_PATH')
    || define('ROOT_PATH', realpath(dirname(dirname(__FILE__))) );

// Define application environment
// defined('APPLICATION_ENV')
    // || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

    // proxy HTTP/1.0 fixs
if ( getenv('APPLICATION_ENV') ) {
	define('APPLICATION_ENV', getenv('APPLICATION_ENV'));
} else if ( getenv('REDIRECT_APPLICATION_ENV') ){
	define('APPLICATION_ENV', getenv('REDIRECT_APPLICATION_ENV'));
} else {
    define('APPLICATION_ENV', 'production');
}

// Define absolute & relative URIs
defined('URL_MAIN_REL')
    || define ('URL_MAIN_REL', rtrim(dirname($_SERVER['PHP_SELF']), '/\\').'/');
defined('URL_MAIN_ABS')
    || define ('URL_MAIN_ABS', 'http://' . $_SERVER['HTTP_HOST'] . URL_MAIN_REL);
    

// Define some usefull constants
define ( 'DS' , DIRECTORY_SEPARATOR );
define ( 'PS' , PATH_SEPARATOR );
define ( 'CRLF' , "\r\n" );
define ( 'TAB' , "\t" );

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(ROOT_PATH . DS . 'library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    ROOT_PATH . DS . 'etc' . DS . 'application.ini'
);

$application->bootstrap()
            ->run();
			
			
			
			
			