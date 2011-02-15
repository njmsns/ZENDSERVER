<?php
/**
 * Cleo Framework
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
 * @package    Cleo_Validate
 * @copyright  Copyright (c) 2005-2010 CLEO CONSULTING (http://www.cleo-consulting.fr)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Password.php 22697 2010-07-26 21:14:47Z alexander $
 */

/**
 * @see Zend_Validate_Abstract
 */
require_once 'Zend/Validate/Abstract.php';

/**
 * @category   Cleo
 * @package    Cleo_Validate
 * @copyright  Copyright (c) 2005-2010 CLEO CONSULTING (http://www.cleo-consulting.fr)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Cleo_Validate_Password extends Zend_Validate_Abstract
{
    const INVALID        	= 'passwordInvalid';
    const BAD_CHARACTERS 	= 'passwordBadCharacters';

    /**
     * @var array
     */
    protected $_messageTemplates = array(
        self::INVALID          => "Donnée invalide, chaîne attendue",
        self::BAD_CHARACTERS => "'**********' comporte des caractères interdits.",
    );

    /**
     * internal options
     *
     * @var array
     */
    protected $_options = array(
        'allowedcharacters' => '[a-zA-Z0-9+-_!#$*/\]'
    );

    /**
     * Sets validator options
     *
     * @param array $options OPTIONAL Options to set
     * @return void
     */
    public function __construct($options = array())
    {
        $this->setOptions($options);
    }

    /**
     * Returns all set options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * Sets the options for this validator
     *
     * @param array $options
     * @return Zend_Validate_Ip
     */
    public function setOptions($options)
    {
        if (array_key_exists('allowedcharacters', $options)) {
            $this->_options['allowedcharacters'] = (string) $options['allowedcharacters'];
        }

        return $this;
    }

    /**
     * Defined by Zend_Validate_Interface
     *
     * Returns true if and only if $value is a valid password 
     *
     * @param  mixed $value
     * @return boolean
     */
    public function isValid($value)
    {
        if (!is_string($value)) {
            $this->_error(self::INVALID);
            return false;
        }
		
        $this->_setValue($value);
		
		
        if (!$this->_validatePassword($value)) {
            $this->_error(self::BAD_CHARACTERS);
            return false;
        }

        return true;
    }

    /**
     * Validates a passwords for a given set of characters
     *
     * @param  string $value Value to check against
     * @return boolean True when $value is a valid password
     *                 False otherwise
     */
    protected function _validatePassword($value) 
	{
		return preg_match($this->_options['allowedcharacters'], $value);
    }
}
