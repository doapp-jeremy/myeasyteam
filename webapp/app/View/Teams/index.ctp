<div class="container">
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
  	<h2>No Teams</h2>
  	<p><?php echo $this->Html->link(__('Add One'), array('controller' => 'Teams', 'action' => 'add'), array('class' => 'btn')); ?>
  </div>
<?php endif; ?>
</div>
