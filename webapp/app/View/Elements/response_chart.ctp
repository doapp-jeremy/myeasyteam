<?php 
if (!isset($divId))
{
  $divId = 'chart_div';
}
$this->assign('useCharts', '1');
?>
<input type='hidden' id='eventId' value='<?= $eventId; ?>' />
<div id="<?= $divId; ?>"></div>
