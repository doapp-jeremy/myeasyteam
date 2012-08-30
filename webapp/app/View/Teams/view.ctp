<?php
$this->AssetCompress->addScript('Teams/view.js'); 
// TODO: how to get this included in head
//$this->AssetCompress->addScript('Events/chart.js');
//$this->assign('useCharts', '1');
?>
<div class="container">
  <div class="hero-unit">
    <h1><?php echo $team['Team']['name']; ?></h1>
    <?php if (!empty($nextEvent)): ?>
      <h2>Next Event</h2>
      <p>
      <?php 
    	$eventTitle = "{$nextEvent['Event']['name']} for team {$nextEvent['Team']['name']} at {$nextEvent['Event']['start']}";
    	echo $eventTitle;
    	?>
      </p>
      <p>
        <?php echo $this->Html->link(__('Go!'), array('controller' => 'Events', 'action' => 'view', $nextEvent['Event']['id']), array('class' => 'btn btn-primary btn-large')); ?>
      </p>
      <p>
        <?php echo $this->element('response_chart', array('eventId' => $nextEvent['Event']['id'], 'divId' => 'chart_div')); ?>
      </p>
    <?php endif; ?>
  </div>
  <?php echo $this->Html->link(__('Add Event'), array('controller' => 'Teams', 'action' => 'add_event', $team['Team']['id']), array('class' => 'btn btn-primary btn-large')); ?>
  <?php // TODO: why isn't the accordion working? ?>
  <div class="accordion-heading"><h2>Upcoming Events</h2></div>
<!--   <div class="accordion-body collapse"> -->
    <div class="accordion-inner">
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Name</th>
            <th>Start</th>
            <th>End</th>
            <th>Location</th>
            <th>actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($team['UpcomingEvent'] as $event): ?>
          <tr>
            <td><?php echo $this->Html->link($event['name'], array('controller' => 'Events', 'action' => 'view', $event['id'])); ?></td>
            <td><?php echo date_create($event['start'], new DateTimezone('UTC'))->format('m/d g:i a'); ?></td>
            <td><?php echo date_create($event['end'], new DateTimezone('UTC'))->format('m/d g:i a'); ?></td>
            <td><?php echo $event['location']; ?></td>
            <td class='editEvent'><?php echo $this->Html->link('edit', array('controller' => 'Events', 'action' => 'edit', $event['id'])); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
<!--     </div> -->
  </div>
  
  <?php // TODO: why isn't the accordion working? ?>
  <div class="accordion-heading"><h2>Players</h2></div>    
<!--   <div class="accordion-body collapse"> -->
    <div class="accordion-inner">
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Type</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($team['Player'] as $player): ?>
          <tr>
            <td><?php echo $player['User']['first_name']; ?></td>
            <td><?php echo $player['User']['last_name']; ?></td>
            <td><?php echo $player['User']['email']; ?></td>
            <td><?php echo $player['PlayerType']['name']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
<!--     </div> -->
  </div>
</div>


<!-- reuseable modal -->
<div class="modal" id="theModal" style="display: none">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3></h3>
	</div>
	<div class="modal-body"></div>
	<div class="modal-footer">
		<div class="spinner" style="width: 20px; height: 20px; float: left;"></div>				
		<a href="#" class="btn closeBtn" data-dismiss="modal">Close</a>
		<a href="#" class="btn btn-info refreshBtn">Refresh</a>
	</div>
</div>
