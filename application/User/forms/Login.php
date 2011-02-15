<?php

class User_Form_Login extends Zend_Form
{
	public function init()
	{
		$this->setAction( '/User/index/connect' );
		
		$username = new Zend_Form_Element_Text('login');
		$username ->setLabel( 'Login :' )
				  ->setRequired( true )
				  ->addFilter( new Zend_Filter_StripTags );
		
		$password = new Zend_Form_Element_Password('password');
		$password ->setLabel( 'Password :' )
				  ->setRequired( true )
				  ->addFilter( new Zend_Filter_StripTags );
		
		$submit   = new Zend_Form_Element_Submit( 'send' );
		$submit ->setLabel( 'Connexion' );
		
		$this->addElements( array( 
			$username,
			$password,
			$submit
		));
	}

}