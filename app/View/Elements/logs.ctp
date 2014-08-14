<?php
	$display = isset($display) ? $display : 'long';
	$links = isset($links) ? $links : true;
?>

<?php foreach($logs as $log) : ?>
	<li class="log-row <?php echo $links ? 'with-links' : 'no-links'; ?>">
		<?php if ($links === true): ?>
			<a href="/items/view/<?php echo $log['Item']['id']; ?>" data-ajax="false">
		<?php endif; ?>
			<span class="log-date"><?php echo date('m/d/y', strtotime($log['Log']['created'])); ?></span>
			<?php switch($log['Log']['code']):
					  case 'add': ?>
				<?php case 'update': ?>
				<?php case 'remove': ?>
				<?php case 'revert': ?>
				<?php default: ?>
					<img class="ui-li-icon" src="/img/<?php echo $log['Log']['code']; ?>.png" />
				<?php break; ?>
				<?php case 'sold': ?>
					<img class="ui-li-icon" src="/img/<?php echo $log['Log']['code']; ?>_<?php echo $log['Item']['auction_house'] == 1 || $log['Item']['auction_house'] == 3 ? 'gold' : 'rmah'; ?>.png" />
				<?php break; ?>
			<?php endswitch; ?>
			<?php if ($display == 'long'): ?>
				<span class="log-name log-detail rarity-<?php echo $log['Item']['rarity_id']; ?>"><?php echo $log['Item']['name']; ?></span>
			<?php endif; ?>
			<?php switch($log['Log']['code']):
					  case 'add': ?>
						<span class="log-action log-detail"><?php echo $display == 'long' ? 'added' : 'Added'; ?></span> to the
				<?php break; ?>
				<?php case 'update': ?>
						<span class="log-action log-detail"><?php echo $display == 'long' ? 'updated' : 'Updated'; ?></span> on the
				<?php break; ?>
				<?php case 'remove': ?>
						<span class="log-action log-detail"><?php echo $display == 'long' ? 'removed' : 'Removed'; ?></span> from the
				<?php break; ?>
				<?php case 'sold': ?>
						<span class="log-action log-detail"><?php echo $display == 'long' ? 'sold' : 'Sold'; ?></span> on the
				<?php break; ?>
				<?php case 'revert': ?>
						<Span class="log-action log-detail"><?php echo $display == 'long' ? 'returned' : 'Returned'; ?></span> to the
				<?php break; ?>
				<?php default: ?>
				<?php break; ?>
			<?php endswitch; ?>
			<?php switch($log['Item']['auction_house']):
					  case 1:
					  default: ?>
						<span class="log-ah log-detail">GAH</span>
				<?php break; ?>
				<?php case 2: ?>
						<span class="log-ah log-detail">RMAH</span>
				<?php break; ?>
				<?php case 3: ?>
						<span class="log-ah log-detail">GAH (HC)</span>
				<?php break; ?>
				<?php case 4: ?>
						<span class="log-ah log-detail">RMAH (HC)</span>
				<?php break; ?>
			<?php endswitch; ?>
			<?php switch($log['Log']['code']):
						case 'add':
						case 'update': ?>
							<?php if (!empty($log['Log']['detail_1']) && !empty($log['Log']['detail_2']) && $log['Log']['detail_1'] != $log['Log']['detail_2']): ?>
							for <span class="log-money log-detail">Bid <?php echo $log['Log']['detail_2']; ?> / Buyout <?php echo $log['Log']['detail_1']; ?></span>
							<?php else: ?>
							for <span class="log-money log-detail"><?php echo max($log['Log']['detail_1'], $log['Log']['detail_2']); ?></span>
							<?php endif; ?>
				  <?php break; ?>
				     <?php case 'sold': ?>
							for <span class="log-money log-detail"><?php echo $log['Log']['detail_1']; ?></span>
							<?php if ($SHOW_BOUGHT_FOR): ?>
								(<?php echo $log['Log']['detail_2'] >= 0 ? '+' : '-'; ?><?php echo $log['Log']['detail_2']; ?>)
							<?php endif; ?>
				  <?php break; ?>
			<?php endswitch; ?>
		<?php if ($links === true): ?>
			</a>
		<?php endif; ?>
	</li>
<?php endforeach; ?>