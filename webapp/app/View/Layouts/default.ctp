<?php //$this->AssetCompress->autoInclude = false; ?>
<!DOCTYPE html>
<html>
	<head>
	  <title><?php echo $title_for_layout;?></title> 
	  <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="author" content="Jeremy McJunkin" />
  	
<?php if (Configure::read('debug') >= 1): ?>
	<link rel="stylesheet" href="/css/cake.debug.css">
<?php endif; ?>
    
    <? if($this->fetch('useCharts')): ?>
    <? // is there a way to use AssetCompress to load this api? ?>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
<!--     <script type="text/javascript" src="/js/jsapi"></script> -->
    <?php // TODO: how to get this included in this spot from element ?>
    <script type="text/javascript" src="/js/Events/chart.js"></script>
    <script type="text/javascript">
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
    </script>
    <? endif ?>
    <?php echo $scripts_for_layout; ?>
    <!-- HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  	<!-- <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" /> -->
  	
  	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> -->
  	<script src="/js/jquery.min.js"></script>
  	
  	<!-- <script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script> -->
  	<?php 
		echo $this->AssetCompress->css('common');
		echo $this->AssetCompress->includeCss();
		?>
	</head>
	<body> 

	  <?php echo $this->element('nav')?>
	  
	  <!-- begin hack -->
	  <br />
    <br />
    <br />
    <br />
    <br />
	  <!--  -->
	  
	  <div  class="container">
  		<?php echo $this->element('alerts'); ?>
      <div class="content">
        <?php
        if (!empty($session)) 
        {
          echo $session->flash();
        }
        ?>
  	    <?php echo $this->fetch('content'); ?>
      </div>
    </div>

    <?php 
		if($this->fetch('useAjaxForm')) {
			echo $this->AssetCompress->script(
				'ajaxForm'
			);
		}
    echo $this->AssetCompress->script('common');
    echo $this->AssetCompress->includeJs();
		echo $scripts_for_layout;
		echo $this->Js->writeBuffer(); // Any Buffered Scripts
		?>
		<?php //echo $facebook->init(); ?>
	</body>
</html>
