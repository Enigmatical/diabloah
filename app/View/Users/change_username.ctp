<?php $this->start('header'); ?>
	<h1>Change Username</h1>
	<a href="/settings" class="ui-btn-left" data-ajax="false" data-icon="arrow-l">Back</a>
<?php $this->end(); ?>

<?php echo $this->Form->create('User', array('action' => 'change_username', 'data-ajax' => 'false')); ?>
	<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $user_id)); ?>
	<ul data-role="listview">
		<li data-role="list-divider" class="divider-1">Important!</li>
		<li class="warning">
			<img class="ui-li-icon" src="/img/warning.png" />
			<div>Please <b>remember</b> your username should you change it.<br />
			<em><b>DO NOT</b> USE YOUR BATTLE.NET USERNAME.</em></div>
		</li>
		<li>
			<label>Current <b>DiabloAH</b> Username</label>
			<div class="item-value"><?php echo $username; ?></div>
		</li>
		<li>
			<?php echo $this->Form->input('username', array('label' => 'New <b>DiabloAH</b> Username')); ?>
		</li>
	</ul>
	<div style="height: 25px;"></div>
	<button type="submit" data-role="button">Save Changes</a>
<?php echo $this->Form->end(); ?>