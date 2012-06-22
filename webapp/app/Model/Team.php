<?php
class Team extends AppModel
{
  
  var $hasMany = array(
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
}