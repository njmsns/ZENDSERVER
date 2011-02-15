<?php

class User_Form_Disconnect extends Zend_Form
{
	public function init()
	{
		$this->setAction( '/User/index/connect' );	
		
		$submit   = new Zend_Form_Element_Submit( 'send' );
		$submit ->setLabel( 'Deconnexion' );
		
		$this->addElements( array( 
			$submit
		));
	}

}