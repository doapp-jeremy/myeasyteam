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
      // TODO: how to set contain before Auth queries for user
      $this->User->contain = array();
      if ($this->Auth->login())
      {
        // set session data
        $this->setSessionData($this->Auth->user());
        if (!$redirectUrl = $this->Session->read('Auth.redirect'))
        {
          $redirectUrl = '/';
        }
        else
        {
          $this->Session->delete('Auth.redirect');
        }
        if ($this->request->is('ajax'))
        {
          $this->renderJsonSuccessForAjaxForm(null,$redirectUrl);
        }
        else 
        {
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
  
  private function setSessionData($user = false)
  {
    // write ability
    // A user that manages a teams can edit it's info, events, players, etc.
    // Only a user that created the team can delete it.
    $teams = $this->User->Team->getTeamsUserOwnsOrManages($user['id']);
    $teamIds = Set::extract('/Team/id', $teams);
    $this->Session->write('Auth.User.Teams.write', $teamIds);
    $deleteAbleTeamIds = array();
    foreach ($teams as $team)
    { 
      if ($team['Team']['user_id'] == $user['id'])
      {
        $deleteAbleTeamIds[] = $team['Team']['id'];
      }
    }
    $this->Session->write('Auth.User.Teams.delete', $deleteAbleTeamIds);
    // events
    $events = $this->User->Team->Event->find('all', array(
        'fields' => array('Event.id'), 'conditions' => array('Event.team_id' => $teamIds)));
    $this->Session->write('Auth.User.Events.write', Set::extract('/Event/id', $events));
    // players
    $players = $this->User->Team->Player->find('all', array(
        'fields' => array('Player.id', 'Player.team_id'), 'conditions' => array('Player.team_id' => $teamIds)));
    $this->Session->write('Auth.User.Players.write', Set::extract('/Player/id', $players));
    //var_dump($this->Session->read('Auth.User.Players.write'));
    
    
    // read ability
    // events
    $teamIds = array_merge($teamIds, Set::extract('/Player/team_id', $players));
    $this->Session->write('Auth.User.Teams.read', $teamIds);
    $events = $this->User->Team->Event->find('all', array(
        'fields' => array('Event.id'), 'conditions' => array('Event.team_id' => $teamIds)));
    $this->Session->write('Auth.User.Events.read', Set::extract('/Event/id', $events));
    //var_dump($this->Session->read('Auth.User.Events.read'));
    
  }
  
  
}
