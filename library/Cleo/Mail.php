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
 * @package    Cleo_Mail
 * @copyright  2010 Jean-Baptiste MONIN - CLEO Consulting
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Mail.php 03 2010-06-10 12:00:00Z jb $
 */
 
 /** Zend_Mail.php */
require_once 'Zend/Mail.php';

class Cleo_Mail Extends Zend_Mail
{
  /**
     * Transport adapter configuration array
     *
     * @var array
     */
    private     $_config;
  /**
     * Transport adapter 
     *
     * @var Zend_Mail_Transport adapter
     */
    private     $_transport;
  /**
     * Sending method
     *
     * @var string ( smtp|smtp/tls|phpmail)
     */
    private     $_method;


   /**
     * Constructor.
     *
     * @param  string $host OPTIONAL (Default: 127.0.0.1)
     * @param  array|null $config OPTIONAL (Default: null)
     * @return void
     */
    public function __construct( $method = 'mail', $charset = 'UTF-8' ) 
    {
        $this->_method              = $method;
        $this->_charset             = $charset;
		
        switch ( $this->_method ) {
            // Methode d'envoi par SMTP sécurisé TLS
            case 'smtp/tls' : 
                $this->_config      = array( 'auth' => 'login',
                                             'username' => $this->_getConfig()->frontoffice->mailer->smtpUser,
                                             'password' => $this->_getConfig()->frontoffice->mailer->smtpPwd,
                                             'ssl' => 'tls',
                                             'port' => $this->_getConfig()->frontoffice->mailer->smtpPort
                                            );
                $this->_transport   = new Zend_Mail_Transport_Smtp( $this->_getConfig()->frontoffice->mailer->smtpHost, $this->_config );
                Zend_Mail::setDefaultTransport( $this->_transport );
            break;
            // Méthode d'envoi par SMTP classique
            case 'smtp' :
                $this->_config      = array( 'port' => $this->_getConfig()->frontoffice->mailer->smtpPort );
                $this->_transport   = new Zend_Mail_Transport_Smtp( $this->_getConfig()->frontoffice->mailer->smtpHost, $this->_config );
                Zend_Mail::setDefaultTransport( $this->_transport );
            break;
            // Méthode d'envoi par fonction mail() ( fonctionnement par défaut)
            case 'mail' :
                // nothing 
            break;
            default :
                // nothing 
            break;
        }
        
    }
    
   protected function _getConfig()
    {
        return Zend_Controller_Front::getInstance()->getParam('config');
    }
}