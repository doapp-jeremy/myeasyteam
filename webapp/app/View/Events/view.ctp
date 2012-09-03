<?php 
// TODO: how to get this included in head
//$this->AssetCompress->addScript('Events/chart.js');
//$this->assign('useCharts', '1');
?>
<div class="container">
  <div class="hero-unit">
    <h1><?php echo $event['Event']['name']; ?></h1>
    <p>
    <?php
    $startDate = date_create($event['Event']['start']);
    $endDate = date_create($event['Event']['end']);
    echo $startDate->format('g:ia l, n/j') . ' - ' .  $endDate->format('g:ia');
    ?>
    </p>
    <p>
    <?php echo $event['Event']['location']; ?>
    </p>
    <p>
    <?php echo $event['Event']['description']; ?>
    </p>
    <p>
    <?php echo $this->Html->link($event['Team']['name'], array('controller' => 'Teams', 'action' => 'view', $event['Event']['team_id']), array('class' => 'btn btn-primary btn-large')); ?>
    </p>
    <p>
      <?php echo $this->element('response_chart', array('eventId' => $event['Event']['id'], 'divId' => 'chart_div')); ?>
    </p>
  </div>
</div>
