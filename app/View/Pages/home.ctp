<?php $this->start('header'); ?>
	<a href="/signup" class="ui-btn-right" data-icon="arrow-r" data-iconpos="right">Join</a>
	<a href="/pages/about" class="ui-btn-left" data-icon="info" data-iconpos="left">About</a>
	<h1>DiabloAH</h1>
<?php $this->end(); ?>

<?php echo $this->Form->create('User', array('action' => 'login', 'data-ajax' => 'false')); ?>
<ul id="login-form" data-role="listview">
	<li data-role="list-divider" class="divider-1">
		Latest News
	</li>
	<li>
		<div>
			<b>DiabloAH</b> has been updated to <b>Revision 5</b>.<br />
			Head over to the new <a href="/pages/updates">Updates</a> page to learn about the exciting new features!
		</div>
	</li>
	<li data-role="list-divider" class="divider-1">Login</li>
	<?php $message = $this->Session->flash(); ?>
	<?php $message .= $this->Session->flash('auth'); ?>
	<?php if ($message): ?>
		<li>
			<?php echo $message; ?>
		</li>
	<?php endif; ?>
	
	<li>
		<?php echo $this->Form->input('username', array('type' => 'email', 'label' => 'Email')); ?>
	</li>
	<li>
		<?php echo $this->Form->input('password'); ?>
	</li>	
</ul>
<div class="list-button-spacer"></div>
<button type="submit" data-role="button">Login</a>
<?php echo $this->Form->end(); ?>
