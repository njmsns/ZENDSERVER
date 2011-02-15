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
 * @package    Cleo_Application
 * @subpackage View
 * @copyright  2010 Jean-Baptiste MONIN - CLEO Consulting
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: View.php 03 2010-06-31712:00:00Z jb $
 */
 
 /** Zend_View.php */
require_once 'Zend/View.php';

class Cleo_View extends Zend_View
{
	public function __construct($options)
    {
		parent::__construct( $options );
    }
	
}