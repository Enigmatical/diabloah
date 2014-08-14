<?php $this->start('header'); ?>
	<h1>Change Password</h1>
	<a href="/settings" class="ui-btn-left" data-ajax="false" data-icon="arrow-l">Back</a>
<?php $this->end(); ?>

<?php echo $this->Form->create('User', array('action' => 'change_username', 'data-ajax' => 'false')); ?>
	<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $user_id)); ?>
	<ul data-role="listview">
		<li data-role="list-divider" class="divider-1">Important!</li>
		<li class="warning">
			<img class="ui-li-icon" src="/img/warning.png" />
			<div>Please <b>remember</b> your password should you change it.<br />
			<em><b>DO NOT</b> USE YOUR BATTLE.NET PASSWORD.</em></div>
		</li>
		<li>
			<?php echo $this->Form->input('password', array('label' => 'New <b>DiabloAH</b> Password')); ?>
		</li>
	</ul>
	<div style="height: 25px;"></div>
	<button type="submit" data-role="button">Save Changes</a>
<?php echo $this->Form->end(); ?>