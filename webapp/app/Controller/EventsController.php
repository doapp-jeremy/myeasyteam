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
class EventsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Events';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

	private function checkAuth($eventId = null, $write = false)
	{
	  if (!$eventId)
	  {
	    $this->Session->setFlash($_('Invalid event id'));
	    $this->redirect(array('action' => 'index'));
	  }
	  if ($write)
	  {
	    if (!in_array($eventId, $this->Session->read('Auth.User.Events.write')))
	    {
	      $this->Session->setFlash($_('You are not authorized'));
	      $this->redirect(array('action' => 'index'));
	    }
	  }
	  if (!in_array($eventId, $this->Session->read('Auth.User.Events.read')))
	  {
	    $this->Session->setFlash(_('You are not authorized'));
	    $this->redirect(array('action' => 'index'));
	  }
	}
	
	function view($id = null)
	{
	  $this->checkAuth($id);
	  
	  $fields = array();
	  $conditions = array('Event.id' => $id);
	  $contain = array(
	      'Team' => array('fields' => array('Team.id', 'Team.name'))
	  );
	  $event = $this->Event->find('first', compact('fields', 'conditions', 'contain'));
	  
	  $this->set(compact('event'));
	}
	
	function getResponses($eventId = null)
	{
	  $this->checkAuth($eventId);
	  
	  $fields = array();
	  $conditions = array('Event.id' => $eventId);
	  $contain = array(
	      'Response' => array('fields' => array('Response.response_type_id'),
	          'ResponseType' => array('fields' => array('ResponseType.name'))
	      )
	  );
	  $event = $this->Event->find('first', compact('fields', 'conditions', 'contain', 'group'));
	  
	  $contentType = 'application/json';
	  header("Content-type: {$contentType}");
	  $this->response->header(array('Content-type' => $contentType));
	  echo json_encode($event);
	  exit();
	}
}