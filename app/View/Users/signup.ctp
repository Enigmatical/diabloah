<?php $this->start('header'); ?>
	<h1>Join</h1>
	<a href="/" class="ui-btn-left" data-icon="arrow-l">Back</a>
<?php $this->end(); ?>

<?php echo $this->Form->create('User', array('action' => 'signup', 'data-ajax' => 'false')); ?>
<ul data-role="listview" id="signup-form">
	<li data-role="list-divider" class="divider-1">Important!</li>
	<li>
		<div><b>DiabloAH</b> is a <em>stand-alone application</em> and <b>DOES NOT</b> require your Battle.net information.<br />An email address and password is only required to <b>uniquely indentify</b> you as a user.  That is it.<br /><em>You can totally use a fake, bogus email address and password as long as you remember it!</em></div>
	</li>
	<li data-role="list-divider" class="divider-1">Sign Up</li>
	
	<?php $message = $this->Session->flash(); ?>
	<?php $message += $this->Session->flash('auth'); ?>
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
<div style="height: 25px;"></div>
<button type="submit" data-role="button">Sign Up</a>
<?php echo $this->Form->end(); ?>