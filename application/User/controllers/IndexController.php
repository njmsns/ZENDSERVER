<?php

 
/** Cleo_Controller_Action.php */
require_once 'Cleo/Controller/Action.php';

class User_IndexController extends Cleo_Controller_Action
{
	private $_messages = null;
	
	public function init()
	{
	}
    /**
     * indexAction
     *
     * @return void
     */
     public function indexAction(){
		
	 }
	 
    /**
     *viewAction
     *
     * @return void
     */
     public function viewAction()
	 {
		$id 		= (int) $this->getRequest()->getParam('id');
		$userMapper = new User_Model_Mapper_User();
		$user       = new User_Model_User();
		
		$userMapper->find( $id, $user );

		$this->view->user = $user;
	 }
	 
	/**
     *listAction
     *
     * @return void
     */
     public function listAction()
	 {
		$userMapper = new User_Model_Mapper_User();
		$list = $userMapper->fetchAll();
		$this->view->users = $list;
	 }

	/**
	*listAction
          *
          * @return void
          */
     public function deleteAction()
	 {
		$id 		= (int) $this->getRequest()->getParam('id');
		$userMapper = new User_Model_Mapper_User();
		if( $userMapper->delete( $id ) ){
			$this->addSystemSuccess('Suppression OK');
		} else {
			$this->addSystemError('Suppression Ko');
		}
		
		$this->_redirect( $this->_helper->url->url( array(), 'userList' ));
	 }
	 
	 /**
	*adduserAction
          *
          * @return void
          */
     public function adduserAction()
	 {
		$form = new User_Form_Adduser();
		if( $this->getRequest()->isPost() ){
			if( $form->isValid( $this->getRequest()->getPost() ) ){
				$user = new User_Model_User();
				$user->populate( $form->getValues() );
				$userMapper = new User_Model_Mapper_User();
				if( $id = $userMapper->save( $user ) ){
					$this->addSystemSuccess('Utilisateur créé');
					//$form->reset();
					$this->_redirect( $this->_helper->url->url( array('id' => $id), 'userById' ));
				} else {
					$this->addSystemError('Echec de la création');
				}
			} else {
				$this->addSystemError('Le formulaire contient 
				des erreurs');
			}
		}
		$this->view->form = $form;
	 }
	 
	 public function connectAction()
	 {
		
		$form = new User_Form_Login();
		
		if( $this->getRequest()->isPost() )
		{
			if( $form->isValid( $this->getRequest()->getPost() ) ){
				$user = new User_Model_User();
				$user->setLogin($form->getValue('login') );
				$user->setPassword($form->getValue('password') );
				
				$userMapper = new User_Model_Mapper_User();
				if( $id = $userMapper->login( $user ) ){
					$this->addSystemSuccess('connexion');
					
					$this->_redirect( $this->_helper->url->url( array(), 'userList' ));
				} else {
					$this->addSystemError('Echec connexion');
				}
			} else {
				$this->addSystemError('echec connexion');
			}
		}
		
		$this->view->form = $form;		
	 }
	 
	public function disconnectAction()
	{
		$auth =  Zend_Auth::getInstance();		
		$this->view->auth = $auth->getIdentity();		
		
		$form = new User_Form_Disconnect();
		
		if( $this->getRequest()->isPost() )
		{
			if( $form->isValid( $this->getRequest()->getPost() ) ){
				
				Zend_Auth::getInstance()->clearIdentity();
				$this->addSystemError('Deconnexion');
				$this->_redirect( $this->_helper->url->url( array(), 'userList' ));
			} else {
				$this->addSystemError('erreur');
			}
		}
		
		$this->view->form = $form;	
	}
}














