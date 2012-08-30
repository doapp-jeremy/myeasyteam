<?php
/**
 * Teams controller.
 *
 * This file will render views from views/teams/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Teams content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TeamsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Teams';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

	function index()
	{
	  $userId = $this->getUserId();
	  $teams = $this->Team->getAllTeams($userId);
	  $this->set(compact('nextEvent', 'teams'));
	}
	
	function home()
	{
	  $userId = $this->getUserId();
	  
	  // get the Users next event
	  $nextEvent = $this->Team->Event->findNextEvent($userId);
	  $teams = $this->Team->getActiveTeams($userId);
	  
	  $this->set(compact('nextEvent', 'teams'));
	}
	
	private function checkAuth($id = null, $write = false)
	{
	  if (!$id)
	  {
	    $this->Session->setFlash($_('Invalid team id'));
	    $this->redirect(array('action' => 'home'));
	  }
	  if ($write)
	  {
	    if (!in_array($id, $this->Session->read('Auth.User.Teams.write')))
	    {
	      $this->Session->setFlash($_('You are not authorized'));
	      $this->redirect(array('action' => 'home'));
	    }
	  }
	  if (!in_array($id, $this->Session->read('Auth.User.Teams.read')))
	  {
	    $this->Session->setFlash($_('You are not authorized'));
	    $this->redirect(array('action' => 'home'));
	  }
	}
	
	function view($id = null)
	{
	  $this->checkAuth($id);
	  
	  $fields = array('Team.id', 'Team.name');
	  $conditions = array('Team.id' => $id);
	  $contain = array(
	      'Player' => array('fields' => array(),'order' => array('Player.player_type_id' => 'ASC'),
	          'PlayerType' => array('fields' => array('PlayerType.name')),
	          'User' => array('fields' => array('User.first_name', 'User.last_name', 'User.email')
	          )
	       ),
	      'UpcomingEvent' => array('fields' => array('UpcomingEvent.id', 'UpcomingEvent.name', 'UpcomingEvent.start', 'UpcomingEvent.end', 'UpcomingEvent.location')
	    )
	  );
	  $team = $this->Team->find('first', compact('fields', 'conditions', 'contain'));
	  // get the Users next event
	  $nextEvent = $this->Team->Event->findNextEvent($this->getUserId(), $id);
	   
	  $this->set(compact('team', 'nextEvent'));
	}
	
	function add_event($id = null)
	{
	  $this->checkAuth($id, true);
	  
	  $fields = array('Team.id', 'Team.name');
	  $conditions = array('Team.id' => $id);
	  $contain = array(
	      'Player' => array('fields' => array(),'order' => array('Player.player_type_id' => 'ASC'),
	          'PlayerType' => array('fields' => array('PlayerType.name')),
	          'User' => array('fields' => array('User.first_name', 'User.last_name', 'User.email')
	          )
	       ),
	      'UpcomingEvent' => array('fields' => array('UpcomingEvent.id', 'UpcomingEvent.name', 'UpcomingEvent.start', 'UpcomingEvent.end', 'UpcomingEvent.location')
	    )
	  );
	  $team = $this->Team->find('first', compact('fields', 'conditions', 'contain'));
	  
	  $this->set(compact('team'));
	}
}
