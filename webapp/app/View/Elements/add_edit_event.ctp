<div>
  <form class="form-horizontal" id="doAdRequest">
    <fieldset>
      <legend>Add Event<?php if (isset($team)): ?> For <?= $team['Team']['name']; ?><?php endif; ?></legend>
      
			<div class="control-group">
				<label for="catId" class="control-label">Name</label>
				<div class="controls">
					<input id="name" class="input-medium" required>
				</div>
			</div>


		</fieldset>
  </form>
</div>
