<?
// http://www.ama3.com/anytime/
echo $this->AssetCompress->css('datetimepicker');
echo $this->AssetCompress->script('datetimepicker');
$this->AssetCompress->addScript('Elements/add_edit_event.js');
?>
<div>
  <form class="form-horizontal" id="doAdRequest" method="post">
  <?php echo $this->Form->create('Event', array(
      'type' => 'post',
      'inputDefaults' => array(
          'class' => 'input-medium',
          'div' => 'control-group',
          'between' => '<div class="controls">',
          'after' => '</div>'
      )
    )); ?>
    <fieldset>
      <legend>Add Event<?php if (isset($team)): ?> For <?= $team['Team']['name']; ?><?php endif; ?></legend>
      <?php echo $this->Form->input('id'); ?>
      <?php 
      $disabled = isset($team) ? 'disabled' : false;
      $type = isset($team) ? 'hidden' : 'select';
      echo $this->Form->input('team_id', array(
			    'type' => $type,
          'options' => $teams,
          'value' => $team['Team']['id'],
          //'disabled' => $disabled // for some reason, whent he input is disabled, it doesn't show up in the post data
			)); ?>
			<?php echo $this->Form->input('name', array(
			    'type' => 'text',
			)); ?>
			<?php echo $this->Form->input('start', array(
			    'type' => 'text',
			)); ?>
			<?php echo $this->Form->input('end', array(
			    'type' => 'text',
			)); ?>
			<?php echo $this->Form->input('location', array(
			    'type' => 'text',
			    'value' => $team['Team']['default_location']
			)); ?>
			<?php echo $this->Form->input('description', array(
			    'type' => 'textarea',
			    'class' => 'input-xlarge'
			)); ?>
			<?php echo $this->Form->input('default_response', array(
			    'type' => 'select',
			    'options' => $responseTypes
			)); ?>
			
      <?php if (false): ?>
			<div class="control-group">
				<label for="catId" class="control-label">Name</label>
				<div class="controls">
					<input id="name" name="name" class="input-medium" required>
				</div>
			</div>
			<div class="control-group">
				<label for="catId" class="control-label">Start</label>
				<div class="controls">
					<input id="start" name="start" class="input-medium" required>
				</div>
			</div>
			<div class="control-group">
				<label for="catId" class="control-label">End</label>
				<div class="controls">
					<input id="end" name="end" class="input-medium" required>
				</div>
			</div>
			<?php endif; ?>
			<div class="form-actions">
				<button class="btn btn-primary" type="submit">Add Event</button>
			</div>

		</fieldset>
  </form>
</div>
