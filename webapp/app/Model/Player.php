<?php
class Player extends AppModel
{
  var $belongsTo = array(
      'User' => array(
          'className' => 'User',
          'foreignKey' => 'user_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      'Team' => array(
          'className' => 'Team',
          'foreignKey' => 'team_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      'PlayerType' => array(
          'className' => 'PlayerType',
          'foreignKey' => 'player_type_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      
  );
  /*
  var $hasMany = array(
      'Response' => array(
          'className' => 'Response',
          'foreignKey' => 'player_id',
          'dependent' => true,
          'conditions' => '',
          'fields' => '',
          'order' => '',
          'limit' => '',
          'offset' => '',
          'exclusive' => '',
          'finderQuery' => '',
          'counterQuery' => ''
      ),
  );
  */
  
  
}
