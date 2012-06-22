<?php
class UsersController extends AppController
{
  function logout()
  {
		$this->Session->destroy();
		return $this->redirect($this->Auth->logout());
  }
  
  function login()
  {
    //If user is already logged in and comes to users/login - send them to their homepage
    if ($this->Session->read('Auth.User'))
    {
      if ($this->request->is('ajax')){
        $this->renderJsonSuccessForAjaxForm(__('Already logged in, redirecting'),'/');
      }
      else {
        $this->Session->setFlash(__('Already logged in'), 'default', array(), 'auth');
        return $this->redirect($this->getUserToHomepage());
      }
    }

    $this->set('title_for_layout', 'Login');
    $this->helpers[] = 'Form';
    $this->helpers[] = 'Html';
    
    if ($this->request->is('post'))
    {
      $this->User->validate['email']['email_rule']['required'] = true;
      $this->User->validate['password_new']['required'] = true;
      $this->User->set($this->request->data);
    
      if (!$this->User->validates())
      {
        self::renderJsonErrorForAjaxForm(__('Oops - please correct errors below'),$this->convertErrorsToAjaxFieldDomIds('User',$this->User->validationErrors));
      }
    
      if ($this->Auth->login())
      {
        if (!$redirectUrl = $this->Session->read('Auth.redirect'))
        {
          $redirectUrl = '/';
        }
        else
        {
          $this->Session->delete('Auth.redirect');
        }
        if ($this->request->is('ajax')){
          $this->renderJsonSuccessForAjaxForm(null,$redirectUrl);
        }
        else {
          return $this->redirect($redirectUrl);
        }
      }
      else
      {
        if ($this->request->is('ajax')){
          self::renderJsonErrorForAjaxForm(__('Invalid username or password'));
        }
        else {
          $this->Session->setFlash(__('Invalid username or password'), 'default', array(), 'auth');
        }
      }
    }
    else
    {
      if ($this->request->is('ajax')){
        self::renderJsonErrorForAjaxForm(__('Invalid request'));
      }
    }
    //$this->render('login2');
  }
}