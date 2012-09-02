<?
echo $this->AssetCompress->css('daterange');
echo $this->AssetCompress->script('daterange');
$this->AssetCompress->addScript('Elements/add_edit_event.js');
?>
<div>
  <form class="form-horizontal" id="doAdRequest">
    <fieldset>
      <legend>Add Event<?php if (isset($team)): ?> For <?= $team['Team']['name']; ?><?php endif; ?></legend>
      
			<div class="control-group">
				<label for="catId" class="control-label">Name</label>
				<div class="controls">
					<input id="name" name="name" class="input-medium" required>
				</div>
			</div>
			<div class="control-group">
				<label for="catId" class="control-label">Date</label>
				<div class="controls">
					<input id="date" name="date" class="input-medium" required>
				</div>
			</div>
			

		</fieldset>
  </form>
</div>
