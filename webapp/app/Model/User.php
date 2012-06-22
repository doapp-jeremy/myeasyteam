<?php
App::uses('AppModel', 'Model');

class User extends AppModel
{
  public $useDbConfig = 'default';
  public $useTable = 'users';
  
  public $validate = array(
  		'email' => array(
  			'email_rule' => array(
  				'rule'     => 'email',
  				'message'  => 'Must enter valid email address'
  			),
  		),
  		'password_new' => array(
  			'rule'    => 'notEmpty',
  			'message'  => 'Password is requried',
  		)
  );
}
