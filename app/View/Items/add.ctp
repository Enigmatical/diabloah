<?php $this->start('header'); ?>
	<?php
		$ah_label = "";
		switch($ah_id) {
			case 1:
				$ah_label = "Gold";
			break;
			case 2:
				$ah_label = "RMAH";
			break;
			case 3:
				$ah_label = "Gold (H)";
			break;
			case 4:
				$ah_label = "RMAH (H)";
			break;
			default:
				$ah_label = "Gold";
			break;
		};
	?>
	<h1>New <?php echo $ah_label; ?> Auction</h1>
	<a href="/items" class="ui-btn-left" data-ajax="false" data-icon="arrow-l">Back</a>
<?php $this->end(); ?>

<script type="text/javascript">
	$.prefs = {};
	$.prefs.required_level_hi = <?php echo $COMPARE_HIGHER_LEVEL; ?>;
	$.prefs.required_level_lo = <?php echo $COMPARE_LOWER_LEVEL; ?>;
	$.prefs.stat_range = <?php echo $COMPARE_STAT_RANGE; ?>;
</script>

<?php echo $this->Form->create('Item', array('data-ajax' => 'false')); ?>
	<?php echo $this->Form->input('status', array('type' => 'hidden', 'value' => 1)); ?>
	<?php echo $this->Form->input('auction_house', array('type' => 'hidden', 'value' => $ah_id)); ?>
	
	<ul class="item-detail-list" data-role="listview">
		<li data-role="list-divider" class="divider-1">
			Loot
		</li>
		<li data-role="list-divider" class="divider-2">
			Details
		</li>
		<li>
			<?php echo $this->Form->input('name'); ?>
		</li>
		<li>
			<?php echo $this->Form->input('rarity_id', array('options' => $Rarities, 'empty' => true)); ?>
		</li>
		<li>
			<?php echo $this->Form->input('category_id', array('options' => $Categories, 'empty' => true)); ?>
		</li>
		<li>
			<?php echo $this->Form->input('type_id', array('class' => 'ajax-item-type')); ?>
		</li>
		<?php /*
		<li>
			<?php echo $this->Form->input('item_level', array('disabled' => 'disabled'));
		</li>
		*/ ?>
		<li>
			<?php echo $this->Form->input('required_level', array('type' => 'number')); ?>
		</li>
		<li>
			<?php echo $this->Form->input('vendor_value', array('type' => 'number', 'label' => 'Sell Value')); ?>
		</li>
		
		
		<li data-role="list-divider" class="divider-2">
			Stats
		</li>
		<li>
			<?php echo $this->Form->input('primary_stat', array('type' => 'number', 'label' => 'Primary Stat (DPS or Armor)')); ?>
		</li>
		<?php for($i = 0; $i < 15; $i++): ?>
		<li class="another-secondary <?php echo $i == 0 ? 'active' : 'hide'; ?>">
			<label>Secondary Stat <?php echo $i + 1; ?></label>
			<?php echo $this->Form->input("ItemStat.$i.stat_id", array('label' => false, 'class' => 'ajax-item-stat')); ?>
			<?php echo $this->Form->input("ItemStat.$i.value", array('label' => false, 'type' => 'number', 'class' => 'stacked-field secondary-stat-value', 'rel' => $i)); ?>		
		</li>
		<?php endfor; ?>
		<li>
			<div>
				<a id="add-another-stat" href="javascript:;" data-role="button" data-icon="plus">Add Another Stat</a>
			</div>
		</li>
		
		<li data-role="list-divider" class="divider-1">
			Comparison
		</li>
		<li data-role="list-divider" class="divider-2">
			Details
		</li>
		<li>
			<label>Category</label>
			<div id="comparison-category" class="item-value">&nbsp;</div>
		</li>
		<li>
			<label>Type</label>
			<div id="comparison-type" class="item-value">&nbsp;</div>
		</li>
		<li>
			<label>Level Required</label>
			<div id="comparison-level-required" class="item-value">&nbsp;</div>
		</li>
		
		<li id="comparison-stats-list-item" data-role="list-divider" class="divider-2">
			Stats
		</li>
		<li id="comparison-stat-primary-container" class="stat-container">
			<div id="comparison-stat-primary-label" class="item-label"></div>
			<div id="comparison-stat-primary-value" class="item-value primary-stat"></div>
		</li>
		
		<?php for($i = 0; $i < 15; $i++): ?>
			<li id="comparison-stat-<?php echo $i; ?>-container" class="stat-container">
				<div id="comparison-stat-<?php echo $i; ?>-label" class="item-label"></div>
				<div id="comparison-stat-<?php echo $i; ?>-value" class="item-value secondary-stat"></div>
			</li>
		<?php endfor; ?>
		
		<li data-role="list-divider" class="divider-1">
			Worth
		</li>
		<li data-role="list-divider" class="divider-2">
			Details
		</li>
		<?php if ($SHOW_BOUGHT_FOR): ?>
			<li>
				<?php echo $this->Form->input('paid', array('type' => 'number', 'label' => 'Bought For')); ?>
			</li>
		<?php endif; ?>
		<li>
			<label for="item-lowest-buyout">Lowest Buyout</label>
			<input type="number" id="item-lowest-buyout" />
		</li>
		<li data-role="list-divider" class="divider-2">
			Suggested Buyouts
		</li>
		
		<li id="suggested-buyout-results"></li>
		
		<li>
			<div id="suggested-buyout-search">
				<a href="javascript:;" id="suggested-buyout-button" data-role="button" data-icon="refresh">Compute</a>
			</div>
		</li>
		
		<li data-role="list-divider" class="divider-1">
			Auction
		</li>
		<li data-role="list-divider" class="divider-2">Bid *</li>
		<li>
			<?php echo $this->Form->input('bid', array('type' => 'number', 'label' => false)); ?>
		</li>
		<li data-role="list-divider" class="divider-2">Buyout *</li>
		<li>
			<?php echo $this->Form->input('buyout', array('type' => 'number', 'label' => false)); ?>
		</li>
	</ul>
	
	<div class="list-button-spacer"></div>
	<a href="javascript:;" data-role="button" data-icon="home" class="auction-button">Auction It!</a>
	
<?php echo $this->Form->end(); ?>