
<div class="container">
  <?php if (!empty($nextEvent)): ?>
  <div class="hero-unit">
    <h1>Next Event</h1>
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
  </div>
  <?php else: ?>
    <div class="hero-unit">
      <h2>No Upcoming Event</h2>
    </div>
  <?php endif; ?>
</div>

<?php if (!empty($teams)): ?>
<div class="row">
<?php foreach ($teams as $team): ?>
	<div class="span4">
	  <h2><?= $team['Team']['name']; ?></h2>
	  <p>
	  <?php echo $this->Html->link(__('View!'), array('controller' => 'Teams', 'action' => 'view', $team['Team']['id']), array('class' => 'btn')); ?>
	  </p>
	</div>
  <?php endforeach; ?>
</div>
<?php else: ?>
  <div class="hero-unit">
  	<h2>No Active Teams</h2>
  	<p><?php echo $this->Html->link(__('View All'), array('controller' => 'Teams', 'action' => 'index'), array('class' => 'btn')); ?>
  </div>
<?php endif; ?>
