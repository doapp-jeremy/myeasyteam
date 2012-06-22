<?php
$this->AssetCompress->addScript(array('Users/login.js'),'users_login');
$this->assign('useAjaxForm', '1'); 
?>
<div data-role="header">
	<h1>Login</h1>
</div>


<form id="loginForm" action="login.php" method="post">
<div class="row">
    <input type="text" name="username" id="username" class="span4" placeholder="Username">
</div>
<div class="row">
    <input type="password" name="password" id="password" class="span4" placeholder="Password">
</div>
<div class="row">
  <button type="submit" name="login" id="login" class="btn btn-primary">Login</button>
</div>
</form>

