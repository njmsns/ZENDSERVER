<?php

class User_Form_Adduser extends Zend_Form
{
	public function init()
	{
		$this->setAction( '/User/index/adduser');
			
		$decorator = array('ViewHelper',
							array( 'Label' , array( 'class' => 'label' )),
							//'Errors',
							'Description',
							array( 'HtmlTag', array( 'tag' => 'p' ))
						  );
						  
		$buttonDecorator = array( 'ViewHelper',
								  array( 'HtmlTag', array( 'tag' => 'p' ))
						  );
						  
		$login = new Zend_Form_Element_Text('login');
		$login	->setLabel('Nom d\'utilisateur :')
				->setRequired(true)
				->setDescription( 'Indiquez votre login ' )
				->addValidator( new Zend_Validate_Alnum() )
				->setDecorators($decorator);
				
		$password = new Zend_Form_Element_Password('password');
		$password	->setLabel('Mot de passe :')
					->setRequired(true)
					->addValidator( new Zend_Validate_Alnum() )
					->setDecorators($decorator);
					
		$password2 = new Zend_Form_Element_Password('password2');
		$password2	->setLabel('Confirmation du mot de passe :')
					->setRequired(true)
					->addValidator( new Zend_Validate_Alnum() )
					->addValidator( new Zend_Validate_Identical('password') )
					->setDecorators($decorator);
		
		$nom = new Zend_Form_Element_Text('nom');
		$nom	->setLabel('Nom :')
				->setRequired(true)
				->addValidator( new Zend_Validate_Alnum() )
				->setDecorators($decorator);
		
		$prenom = new Zend_Form_Element_Text('prenom');
		$prenom	->setLabel('Prénom :')
				->setRequired(true)
				->addValidator( new Zend_Validate_Alnum() )
				->setDecorators($decorator);
				
		$email = new Zend_Form_Element_Text('email');
		$email	->setLabel('Email :')
				->setRequired(true)
				->addValidator( new Zend_Validate_EmailAddress() )
				->setDecorators($decorator);
				
		$tel = new Zend_Form_Element_Text('telephone');
		$tel	->setLabel('Téléphone :')
				->setRequired(true)
				->addValidator( new Cleo_Validate_PhoneNumber_French() )
				->setDecorators($decorator);
				
		$civArray  = array( 'M' => 'M.', 
						    'Mme' => 'Mme.',
							'Melle' => 'Melle.');
		$civilite = new Zend_Form_Element_Select('civilite');
		$civilite->setLabel('Civilité :')
				 ->setMultiOptions( $civArray )
				 ->setRequired(true)
				 ->setDecorators($decorator);
				
		 $params = array( 'ssl' => false,
						   'error' => null,
						   'xhtml' => true
						 );
		 $options = array( 'theme' => 'white',
						   'lang' => 'fr'
						);
						
		$publicKey 	= '6LdoLcASAAAAAAFm5pnMOnHA2KjkI6KctRBBOfNS';
		$privateKey = '6LdoLcASAAAAABb0_ZBSFJdByFzFS6YzskE3BMJ8';
	    $reCaptcha 	= new Zend_Service_ReCaptcha( $publicKey, $privateKey,$params, $options );
											  
		 $adapter   = new Zend_Captcha_ReCaptcha();
		 $adapter->setService( $reCaptcha );

		 $captcha = new Zend_Form_Element_Captcha('captcha', 
		 array( 'label' => 'vérification d\'humanitude', 'captcha' => $adapter ));

		
		$submit = new Zend_Form_Element_Submit('send');
		$submit->setLabel( 'Enregistrer' )
			   ->setAttrib('class' , 'button' )
			   ->setDecorators($buttonDecorator);
		
		$this->addElements( array( $login, 
								   $password,
								   $password2,
								   $civilite,
								   $nom, 
								   $prenom,
								   $email,
								   $tel,
								   $submit)
						  );
						  
		$this->setDecorators( array( 'FormErrors',
									 'FormElements',
									 'Form' ) );
	}
	
}