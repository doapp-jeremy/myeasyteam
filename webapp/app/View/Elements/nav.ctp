<div class="navbar navbar-fixed-top" data-dropdown="dropdown" id="topNav">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="brand" href="/">My EZ Team</a>
			<ul id="mainNav" class="nav">
				<li id="teamsNav"><?php echo $this->Html->link('Teams', array('controller' => 'Teams', 'action' => 'index')); ?></li>
				<!-- 
				<li id="adsNav" class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Ads <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="nav-header">Ad serving</li>
						<li><a href="/ads/">Get available ads</a></li>
						<li><a href="/ads/getResponse">Get specific ad response (by adc_id)</a></li>
						<li><a href="/ads/simulateRequest">Simulate ad request</a></li>		
						<li><a href="/ads/getMemcacheForAd">Get memcache entry for ad</a></li>
						<li><a href="/ads/clearCache">Clear ad campaign cache</a></li>
						<li><a href="http://adserving.mobilelocalnews.com/status.php?show_errors=1&K=2aadab00f8fd47188a3f5056addf8084" target="_blank">DB status</a></li>
						
					</ul>
				</li>	
				<li id="clearCacheNav" class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Clear cache <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="nav-header">Ad serving</li>
						<li><a href="/ads/clearCache">Ad campaign cache</a></li>
						<li class="divider"></li>
						<li class="nav-header">Image service</li>
						<li><a href="https://sites.google.com/a/doapps.com/doapp-intranet/research-and-development/application-documentation#TOC-Clearing-cache">Image cache</a></li>						
					</ul>
				</li>
				<li id="publisherNav"><a href="/Publishers/invoices">Publishers</a></li>
				 -->
				<li class="divider-vertical"></li>
				<li><div class="spinner" class="pull-right" style="width: 19px; height: 19px; padding: 10px 10px 11px; color: white;"></div></li>		
			</ul>
			
			<?php if ($user = $this->Session->read('Auth.User')): ?>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i><?= $user['email']; ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><?php echo $this->Html->link('Profile', array('controller' => 'Users', 'action' => 'edit', $user['id'])); ?></li>
              <li class="divider"></li>
              <li><?php echo $this->Html->link('Sign Out', array('controller' => 'Users', 'action' => 'logout')); ?></li>
            </ul>
          </div>
      <?php else: ?>
        <div class="btn pull-right">
          <?php echo $this->Html->link('Login', array('controller' => 'Users', 'action' => 'login')); ?>
        </div>
      <?php endif; ?>
		</div>
	</div>
</div>
