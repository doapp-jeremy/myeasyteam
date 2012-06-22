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
<?php endif; ?>
