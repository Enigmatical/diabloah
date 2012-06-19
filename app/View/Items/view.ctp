<?php $this->start('header'); ?>
	<h1 class="rarity-<?php echo strtolower($item['Rarity']['name']); ?>"><?php echo $item['Item']['name']; ?></h1>
	<a href="/items" class="ui-btn-left" data-ajax="false" data-icon="arrow-l">Back</a>
<?php $this->end(); ?>

<script type="text/javascript">
	$.prefs = {};
	$.prefs.required_level_hi = <?php echo $COMPARE_HIGHER_LEVEL; ?>;
	$.prefs.required_level_lo = <?php echo $COMPARE_LOWER_LEVEL; ?>;
	$.prefs.stat_range = <?php echo $COMPARE_STAT_RANGE; ?>;
</script>

<?php echo $this->Form->create('Item', array('data-ajax' => 'false')); ?>
	<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $item['Item']['id'])); ?>
	<?php echo $this->Form->input('name', array('type' => 'hidden', 'value' => $item['Item']['name'])); ?>
	<?php echo $this->Form->input('status', array('type' => 'hidden', 'value' => $item['Item']['status'])); ?>
	<?php echo $this->Form->input('auction_house', array('type' => 'hidden', 'value' => $item['Item']['auction_house'])); ?>
	<?php echo $this->Form->input('rarity_id', array('type' => 'hidden', 'value' => $item['Item']['rarity_id'])); ?>
	<?php echo $this->Form->input('vendor_value', array('type' => 'hidden', 'value' => $item['Item']['vendor_value'])); ?>
	<?php echo $this->Form->input('paid', array('type' => 'hidden', 'value' => $item['Item']['paid'])); ?>
	
	<ul class="item-detail-list" data-role="listview">
		<li data-role="list-divider" class="divider-1">
			Loot
		</li>
		<li data-role="list-divider" class="divider-2">
			Details
		</li>
		<li>
			<label>Name</label>
			<div class="item-value rarity-<?php echo $item['Item']['rarity_id']; ?>"><?php echo $item['Item']['name']; ?></div>
		</li>
		<li>
			<label>Type</label>
			<div class="item-value"><?php echo $item['Category']['name']; ?> <?php echo $item['Type']['name']; ?></div>
		</li>
		<?php /*
		<li>
			<?php echo $this->Form->input('item_level', array('disabled' => 'disabled'));
		</li>
		*/ ?>
		<li>
			<label>Required Level</label>
			<div class="item-value"><?php echo $item['Item']['required_level']; ?></div>
		</li>
		<li>
			<label>Sale Value</label>
			<div class="item-value"><?php echo $item['Item']['vendor_value']; ?></div>
		</li>
		
		<li data-role="list-divider" class="divider-2">
			Stats
		</li>
		<?php if (!empty($item['Item']['primary_stat'])): ?>
			<li>
				<label>Primary Stat (DPS or Armor)</label>
				<div class="item-value"><?php echo $item['Item']['primary_stat']; ?></div>
			</li>		
		<?php endif; ?>
		<?php foreach($item['ItemStat'] as $ItemStat): ?>
			<li>
				<label><?php echo $ItemStat['Stat']['name']; ?></label>
				<div class="item-value"><?php echo $ItemStat['value']; ?></div>
			</li>
		<?php endforeach; ?>

		<?php if ($item['Item']['status'] == 1): ?>
			<li data-role="list-divider" class="divider-1">
				Comparison
			</li>	
			<li data-role="list-divider" class="divider-2">
				Details
			</li>
			<li>
				<label>Category</label>
				<div class="item-value"><?php echo $item['Category']['name']; ?></div>
				<?php echo $this->Form->input('category_id', array('type' => 'hidden', 'value' => $item['Item']['category_id'])); ?>
			</li>
			<li>
				<label>Type</label>
				<div class="item-value"><?php echo $item['Type']['name']; ?></div>
				<?php echo $this->Form->input('type_id', array('type' => 'hidden', 'value' => $item['Item']['type_id'])); ?>
			</li>
			<li>
				<label>Level Required</label>
				<?php
					$highLevel = $item['Item']['required_level'] + 1;
					$lowLevel = $item['Item']['required_level'] - 3;
					if ($highLevel > 60) { $highLevel = 60; }
					if ($lowLevel < 1) { $lowLevel = 1; }
				?>
				<div class="item-value"><?php echo $lowLevel; ?> - <?php echo $highLevel; ?></div>
				<?php echo $this->Form->input('required_level', array('type' => 'hidden', 'value' => $item['Item']['required_level'])); ?>
			</li>
			
			<li data-role="list-divider" class="divider-2">
				Stats
			</li>
			<?php if (!empty($item['Item']['primary_stat'])): ?>
				<li>
					<?php if ($item['Item']['category_id'] == 1 || $item['Item']['category_id'] == 2): ?>
						<label>DPS</label>
					<?php else : ?>
						<label>Armor</label>
					<?php endif; ?>
					<div class="item-value"><?php echo $item['Item']['primary_stat']; ?></div>
					<?php echo $this->Form->input('primary_stat', array('type' => 'hidden', 'value' => $item['Item']['primary_stat'])); ?>
				</li>
			<?php endif; ?>
			<?php $ind = 0; ?>
			<?php foreach($item['ItemStat'] as $ItemStat): ?>
				<li>
					<label><?php echo $ItemStat['Stat']['name']; ?></label>
					<?php
						$reducedStat = $ItemStat['value'] - ($ItemStat['value'] * 0.15);
						
						if (is_int(intval($ItemStat['value']))) {
							$reducedStat = floor($reducedStat);
						} else {
							$reducedStat = round($reducedStat, 2);
						}
					?>
					<div class="item-value"><?php echo $reducedStat; ?></div>
					<?php echo $this->Form->input('ItemStat.'.$ind.'.stat_id', array('type' => 'hidden', 'value' => $ItemStat['stat_id'])); ?>
					<?php echo $this->Form->input('ItemStat.'.$ind.'.value', array('type' => 'hidden', 'value' => $ItemStat['value'])); ?>		
					<?php $ind++; ?>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if (count($logs) > 0) : ?>
			<li data-role="list-divider" class="divider-1">
				History
			</li>
			<li data-role="list-divider" class="divider-2">
				<?php echo count($logs); ?> Actions
			</li>
			<?php echo $this->element('logs', array('display' => 'short', 'links' => false, 'logs' => $logs)); ?>
		<?php endif; ?>
		<?php if ($item['Item']['status'] == 1): ?>
			<li data-role="list-divider" class="divider-1">
				Worth
			</li>
			<li data-role="list-divider" class="divider-2">
				Details
			</li>
			<?php if ($SHOW_BOUGHT_FOR): ?>
				<?php if ($item['Item']['paid'] > 0) : ?>
					<li>
						<label>Bought For</label>
						<div class="item-value"><?php echo $item['Item']['paid']; ?></div>
					</li>
				<?php endif; ?>
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
				<?php echo $this->Form->input('bid', array('type' => 'number', 'label' => false, 'value' => $item['Item']['bid'] )); ?>
			</li>
			<li data-role="list-divider" class="divider-2">Buyout *</li>
			<li>
				<?php echo $this->Form->input('buyout', array('type' => 'number', 'label' => false, 'value' => $item['Item']['buyout'] )); ?>
			</li>
		<?php endif; ?>
	</ul>
	
	<?php if ($item['Item']['status'] == 1): ?>
		<div class="list-button-spacer"></div>
		<a href="javascript:;" data-role="button" data-icon="check" class="success-button">Success!</a>
		<a href="javascript:;" data-role="button" data-icon="home" class="auction-button">Auction It!</a>
		<a href="javascript:;" data-role="button" data-icon="delete" class="remove-button">Remove</a>
	<?php endif; ?>

<?php echo $this->Form->end(); ?>