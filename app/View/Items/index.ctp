<?php $this->start('header'); ?>
	<h1>Auctions</h1>
	<a href="/logout" data-ajax="false" data-icon="arrow-l" class="ui-btn-left">Logout</a>
	<a href="/settings" data-ajax="false" data-icon="gear" class="ui-btn-right">Settings</a>
	<div data-role="navbar">
		<ul>
			<li><a id="gold-auctions" href="#" class="tab ui-btn-active">GOLD (<?php echo count($auctions['gold']['normal']['auctions']) + count($auctions['gold']['hardcore']['auctions']); ?>)</a></li>
			<li><a id="rmah-auctions" class="tab" href="#">RMAH (<?php echo count($auctions['rmah']['normal']['auctions']) + count($auctions['rmah']['hardcore']['auctions']); ?>)</a></li>
			<li><a id="log-auctions" href="#" class="tab">LOG</a></li>
		</ul>
	</div>
<?php $this->end(); ?>

<ul id="gold-auctions-list" data-role="listview" class="item-detail-list tab-section">
	<li class="divider-1" data-role="list-divider">
		<div class="divider-right"><a href="/items/add?ah=gold_normal" class="divider-button" data-ajax="false" data-icon="plus" data-role="button" data-mini="true" data-inline="true">Auction</a></div>
		<div>Normal</div>
		<div class="sub-divider-1"><b><?php echo count($auctions['gold']['normal']['auctions']); ?></b> Auctions, <b><?php echo count($auctions['gold']['normal']['sales']); ?></b> Sales, <b><?php echo number_format($auctions['gold']['normal']['profit']); ?></b> Profits</div>
	</li>
	<?php foreach($auctions['gold']['normal']['auctions'] as $item) : ?>
		<li class="rarity-<?php echo strtolower($item['Item']['rarity_id']); ?> item-row">
			<a data-ajax="false" href="/items/view/<?php echo $item['Item']['id']; ?>" class="gothic"><?php echo $item['Item']['name']; ?>, <span class="addtl-notes">Level <?php echo $item['Item']['required_level']; ?> <?php echo $item['Category']['name']; ?> <?php echo $item['Type']['name']; ?></span></a></li>
	<?php endforeach; ?>
	<?php if ($SHOW_HARDCORE): ?>
		<li class="divider-1" data-role="list-divider">
			<div class="divider-right"><a href="/items/add?ah=gold_hardcore" class="divider-button" data-ajax="false" data-icon="plus" data-role="button" data-mini="true" data-inline="true">Auction</a></div>
			<div>Hardcore</div>
			<div class="sub-divider-1"><b><?php echo count($auctions['gold']['hardcore']['auctions']); ?></b> Auctions, <b><?php echo count($auctions['gold']['hardcore']['sales']); ?></b> Sales, <b><?php echo number_format($auctions['gold']['hardcore']['profit']); ?></b> Profits</div>
		</li>
		<?php foreach($auctions['gold']['hardcore']['auctions'] as $item) : ?>
			<li class="rarity-<?php echo strtolower($item['Item']['rarity_id']); ?> item-row"><a data-ajax="false" href="/items/view/<?php echo $item['Item']['id']; ?>" class="gothic"><?php echo $item['Item']['name']; ?>, <span class="addtl-notes">Level <?php echo $item['Item']['required_level']; ?> <?php echo $item['Category']['name']; ?> <?php echo $item['Type']['name']; ?></span></a></li>
		<?php endforeach; ?>

	<?php endif; ?>
</ul>

<ul id="rmah-auctions-list" data-role="listview" class="item-detail-list tab-section">
	<li class="divider-1" data-role="list-divider">
		<div class="divider-right"><a href="/items/add?ah=rmah_normal" class="divider-button" data-ajax="false" data-icon="plus" data-role="button" data-mini="true" data-inline="true">Auction</a></div>
		<div>Normal</div>
		<div class="sub-divider-1"><b><?php echo count($auctions['rmah']['normal']['auctions']); ?></b> Auctions, <b><?php echo count($auctions['rmah']['normal']['sales']); ?></b> Sales, <b><?php echo sprintf("%01.2f", $auctions['rmah']['normal']['profit']); ?></b> Profits</div>
	</li>
	<?php foreach($auctions['rmah']['normal']['auctions'] as $item) : ?>
		<li class="rarity-<?php echo strtolower($item['Item']['rarity_id']); ?> item-row">
			<a data-ajax="false" href="/items/view/<?php echo $item['Item']['id']; ?>" class="gothic"><?php echo $item['Item']['name']; ?>, <span class="addtl-notes">Level <?php echo $item['Item']['required_level']; ?> <?php echo $item['Category']['name']; ?> <?php echo $item['Type']['name']; ?></span></a></li>
	<?php endforeach; ?>

	<?php /*
	<?php if ($SHOW_HARDCORE): ?>
		<li class="divider-1" data-role="list-divider">
			<div class="divider-right"><a href="/items/add?ah=rmah_hardcore" class="divider-button" data-ajax="false" data-icon="plus" data-role="button" data-mini="true" data-inline="true">Auction</a></div>
			<div>Hardcore</div>
			<div class="sub-divider-1"><b><?php echo count($auctions['rmah']['hardcore']['auctions']); ?></b> Auctions, <b><?php echo count($auctions['rmah']['hardcore']['sales']); ?></b> Sales, <b><?php echo sprintf("%01.2f", $auctions['rmah']['hardcore']['profit']); ?></b> Profits</div>
		</li>
		<?php foreach($auctions['rmah']['hardcore']['auctions'] as $item) : ?>
			<li class="rarity-<?php echo strtolower($item['Item']['rarity_id']); ?> item-row"><a data-ajax="false" href="/items/view/<?php echo $item['Item']['id']; ?>" class="gothic"><?php echo $item['Item']['name']; ?>, <span class="addtl-notes">Level <?php echo $item['Item']['required_level']; ?> <?php echo $item['Category']['name']; ?> <?php echo $item['Type']['name']; ?></span></a></li>
		<?php endforeach; ?>
	<?php endif; ?>
	*/ ?>
</ul>

<div id="log-auctions-list" class="tab-section">
	<input type="hidden" id="max-log-count" value="<?php echo $log_count; ?>" />
	<input type="hidden" id="cur-log-count" value="<?php echo count($logs); ?>" />
	<ul id="log-auctions-list-ul" data-role="listview" class="item-detail-list">
		<?php echo $this->element('logs', array('display' => 'long', 'logs' => $logs)); ?>
	</ul>
	<?php if ($log_count > count($logs)) : ?>
		<div class="list-button-spacer"></div>
		<a href="javascript:;" id="more-logs-button" data-role="button" data-icon="refresh">Show More</a>
	<?php endif; ?>
</div>
