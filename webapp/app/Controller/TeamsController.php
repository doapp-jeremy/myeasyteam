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

	function home()
	{
	  $userId = $this->getUserId();
	  
	  // get the Users next event
	  $nextEvent = $this->Team->Event->findNextEvent($userId);
	  $teams = $this->Team->getActiveTeams($userId);
	  
	  $this->set(compact('nextEvent', 'teams'));
	}
}
