<?php
class Team extends AppModel
{
  var $hasMany = array(
      'UpcomingEvent' => array(
          'className' => 'Event',
          'foreignKey' => 'team_id',
          'dependent' => true,
          'conditions' => array('UpcomingEvent.start >= UTC_TIMESTAMP() OR UpcomingEvent.end >= UTC_TIMESTAMP()'),
          'fields' => '',
          'order' => array('UpcomingEvent.start' => 'ASC', 'UpcomingEvent.end' => 'ASC'),
          'limit' => '',
          'offset' => '',
          'exclusive' => '',
          'finderQuery' => '',
          'counterQuery' => ''
      ),
      'Event' => array(
          'className' => 'Event',
          'foreignKey' => 'team_id',
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
      'Player' => array(
          'className' => 'Player',
          'foreignKey' => 'team_id',
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
  
  public function getActiveTeams($userId)
  {
    $query = "
      SELECT
        Team.id, Team.name, Team.facebook_group,
        Event.id, Event.name, Event.start, Event.end
      FROM
        players AS Player
        LEFT JOIN teams AS Team ON (Team.id = Player.team_id)
        LEFT JOIN events AS Event ON (Event.team_id = Team.id AND Event.start > NOW())
      WHERE
        Player.user_id = {$userId}
        AND Event.id IS NOT NULL
      GROUP BY
        Team.id
    ";
    
    //debug(preg_replace('/\s+/', ' ', $query));
    $teams = $this->query($query);
    return $teams;
  }
  
  public function getTeamsUserOwnsOrManages($userId)
  {
    $query = "
      SELECT
        Team.id, Team.user_id
      FROM
        teams AS Team
        LEFT JOIN teams_managers AS Manager ON (Manager.team_id = Team.id)
      WHERE
        Team.user_id = {$userId}
        OR Manager.user_id = {$userId}
      GROUP BY
        Team.id
    ";
    
    //debug(preg_replace('/\s+/', ' ', $query));
    $teams = $this->query($query);
    return $teams;
  }

  public function getAllTeams($userId, $order = 'Team.name asc')
  {
    $query = "
      SELECT
        Team.id, Team.name
      FROM
        teams AS Team
        LEFT JOIN teams_managers AS Manager ON (Manager.team_id = Team.id)
        LEFT JOIN players AS Player ON (Player.team_id = Team.id)
      WHERE
        Team.user_id = {$userId}
        OR Manager.user_id = {$userId}
        OR Player.user_id = {$userId}
      GROUP BY
        Team.id
    ";
    
    if ($order)
    {
      $query.= ' ORDER BY ' . $order;
    }
    
    //debug(preg_replace('/\s+/', ' ', $query));
    $teams = $this->query($query);
    return $teams;
  }
  
  
//   public function getTeamsUserIsOn($userId)
//   {
//     $query = "
//       SELECT
//         Team.id,
//         Player.id
//       FROM
//         teams AS Team
//         LEFT JOIN players AS Player ON (Player.team_id = Team.id)
//       WHERE
//         Player.user_id = {$userId}
//       GROUP BY
//         Team.id
//     ";
    
//     //debug(preg_replace('/\s+/', ' ', $query));
//     $teams = $this->query($query);
//     return $teams;
//   }
}
