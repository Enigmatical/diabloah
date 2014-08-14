<?php $this->start('header'); ?>
	<a href="/signup" class="ui-btn-right" data-icon="arrow-r" data-iconpos="right">Join</a>
	<a href="/pages/about" class="ui-btn-left" data-icon="info" data-iconpos="left" data-ajax="false">About</a>
	<h1>DiabloAH</h1>
<?php $this->end(); ?>

<?php echo $this->Form->create('User', array('action' => 'login', 'data-ajax' => 'false')); ?>
<ul id="login-form" data-role="listview">
	<li data-role="list-divider" class="divider-1">
		Welcome
	</li>
	<li>
		<img class="ui-li-icon" src="/img/info.png" />
		<div>
			<b>DiabloAH</b> has helped <b><?php echo number_format($total_active_users); ?> people</b> sell <b><?php echo number_format($total_item_sales); ?> items</b>.<br />
			<a href="/pages/about">Learn more about DiabloAH</a> and <a href="/signup" data-ajax="false">Join the Community</a>!
		</div>
	</li>
	<li>
		<img class="ui-li-icon" src="/img/app-update.png" />
		<div>
			<b>DiabloAH</b> has reached <b>Level 7</b>!
			<ul>
				<li>Better <b>Market Research</b> Suggestions</li>
				<li>Support for Bid-Only Auctions</li>
				<li>Update Account Credentials</li>
				<li>... and much more!</li>
			</ul>
			Head over to the <a href="/pages/updates">Updates</a> page to learn about the exciting <b>NEW</b> features!
		</div>
	</li>
	<li>
		<img class="ui-li-icon" src="/img/help.png" />
		<div>
			Comments?  Questions?  Concerns?  Praise?<br />
			You can reach me on either <a href="http://www.reddit.com/user/functioning/" target="_blank">Reddit</a> or <a href="https://github.com/Enigmatical/diabloah/issues?state=open" target="_blank">GitHub</a>.
		</div>
	</li>
	<li data-role="list-divider" class="divider-1">Login</li>
	<li class="info">
		<img class="ui-li-icon" src="/img/info.png" />
		<div>To login, use your <b>DiabloAH</b> <b>Username</b> and <b>Password</b>.<br />
		Don't have a <b>DiabloAH</b> Account yet?  You can <b>create one</b> on the <a href="/signup">Join</a> page.<br />
	</li>
	<?php $message = $this->Session->flash(); ?>
	<?php $message .= $this->Session->flash('auth'); ?>
	<?php if ($message): ?>
		<li class="error">
			<img class="ui-li-icon" src="/img/error.png" />
			<b><?php echo $message; ?></b>
		</li>
	<?php endif; ?>
	
	<li>
		<?php echo $this->Form->input('username', array('label' => '<b>DiabloAH</b> Username')); ?>
	</li>
	<li>
		<?php echo $this->Form->input('password', array('label' => '<b>DiabloAH</b> Password')); ?>
	</li>
</ul>
<div class="list-button-spacer"></div>
<button type="submit" data-role="button">Login</a>
<?php echo $this->Form->end(); ?>
