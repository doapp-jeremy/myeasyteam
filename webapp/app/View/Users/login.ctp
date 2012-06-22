<?php
$this->AssetCompress->addScript(array('Users/login.js'),'users_login');
$this->assign('useAjaxForm', '1'); 
?>
<div data-role="header">
	<h1>Login</h1>
</div>

<?php
//Setup bootstrap defaults - see http://twitter.github.com/bootstrap/base-css.html#forms
echo $this->Form->create('User', array(
	'id'=>'userLoginForm',
	'action' => 'login',
	//'class' => 'form-horizontal',	
    'inputDefaults' => array(
		//'between'=>'<div class="row">',
		//'after'=>'</div>',
    'label' => false,
		'class'=>'input-xlarge span4 placeholder',
    'required',
		'div'=>array('class'=>'row'),
    )
));    
?>

<fieldset>
	<?php
    echo $this->Form->input('email', array(
    		'type'=>'email',	//Set HTML5 type attribure
    		'title'=>'Email Address',
    		'placeholder'=>'email@you.com'
    ));
    echo $this->Form->input('password_new', array(
        'type'=>'password',
        'placeholder'=>'password',
        'title' => 'Password',
    )); 
	?>
    <div class="row">
		<?php echo $this->Form->submit('Login',array('class'=>'btn btn-primary'));?>
	</div>
</fieldset>	
<?php echo $this->Form->end(); ?>

<?php 
//Internationalize by using __() methods: http://book.cakephp.org/2.0/en/core-libraries/internationalization-and-localization.html
echo $this->Html->link(__('Forgot your password?'), array('controller' => 'Users', 'action' => 'reset')); 
?>


