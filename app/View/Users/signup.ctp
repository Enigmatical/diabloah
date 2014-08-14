<?php $this->start('header'); ?>
	<h1>Join</h1>
	<a href="/" class="ui-btn-left" data-icon="arrow-l">Back</a>
<?php $this->end(); ?>

<?php echo $this->Form->create('User', array('action' => 'signup', 'data-ajax' => 'false')); ?>
<ul data-role="listview" id="signup-form">
	<li data-role="list-divider" class="divider-1">Important!</li>
	<li class="warning">
		<img class="ui-li-icon" src="/img/warning.png" />
		<div>In order to save your items and settings, <b>DiabloAH</b> does require a login.<br />
		Please remember your <b>username</b> and <b>password</b>.<br />
		<em>PLEASE <b>DO NOT</b> USE YOUR BATTLE.NET USERNAME AND PASSWORD.</em></div>
	</li>
	<li data-role="list-divider" class="divider-1">Sign Up</li>
	
	<?php $message = $this->Session->flash(); ?>
	<?php $message += $this->Session->flash('auth'); ?>
	<?php if ($message): ?>
		<li class="error">
			<img class="ui-li-icon" src="/img/error.png" />
			<?php echo $message; ?>
		</li>
	<?php endif; ?>
	
	<li>
		<?php echo $this->Form->input('username', array('label' => 'New <b>DiabloAH</b> Username')); ?>
	</li>
	<li>
		<?php echo $this->Form->input('password', array('label' => 'New <b>DiabloAH</b> Password')); ?>
	</li>
</ul>
<div style="height: 25px;"></div>
<button type="submit" data-role="button">Sign Up</a>
<?php echo $this->Form->end(); ?>