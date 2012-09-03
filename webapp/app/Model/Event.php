<?php
class Event extends AppModel
{
  var $belongsTo = array(
      'Team' => array(
          'className' => 'Team',
          'foreignKey' => 'team_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      'ResponseType' => array(
          'className' => 'ResponseType',
          'foreignKey' => 'response_type_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      
  );
  
  var $hasMany = array(
      'Response' => array(
          'className' => 'Response',
          'foreignKey' => 'event_id',
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
  
  
  function findNextEvent($userId, $teamId = false)
  {
    $query = "
      SELECT
        Event.id, Event.name, Event.start, Event.end, Event.response_type_id,
        Team.id, Team.name,
        Response.response_type_id
      FROM
        players AS Player
        LEFT JOIN teams AS Team ON (Team.id = Player.team_id)
        LEFT JOIN events AS Event ON (Event.team_id = Team.id)
        LEFT JOIN responses AS Response ON (Response.event_id = Event.id AND Response.player_id = Player.id)
      WHERE
        Player.user_id = {$userId}
        AND Event.start > NOW()
    ";
    if ($teamId)
    {
      $query.= " AND Team.id = {$teamId}";
    }
    $query.= "
      GROUP BY
        Event.id
      ORDER BY
        Event.start ASC
      LIMIT 1
    ";
    
    //debug(preg_replace('/\s+/', ' ', $query));
    $event = $this->query($query);
    return !empty($event) ? $event[0] : array();
  }
  
}
