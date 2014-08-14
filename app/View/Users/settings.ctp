<?php $this->start('header'); ?>
	<h1>Settings</h1>
	<a href="/items" class="ui-btn-left" data-ajax="false" data-icon="arrow-l">Back</a>
<?php $this->end(); ?>

<ul data-role="listview">
	<li data-role="list-divider" class="divider-1">
		Account
	</li>
	<li>
		<a href="/change_username" data-ajax="false">Change Username</a>
	</li>
	<li>
		<a href="/change_password" data-ajax="false">Change Password</a>
	</li>
	<li data-role="list-divider" class="divider-1">
		Preferences
	</li>
	<li data-role="list-divider" class="divider-2">
		General
	</li>
	<li>
		<label>Compact Mode</label>
		<p><b>Compact Mode</b> limits the Secondary Stat selection to a much smaller sample of <b>Core Stats</b>.  Disabling this feature will show all Secondary Stats for a particular Item Category (i.e. Class-Specific Stats, Resistance Types, Chance on Hit Types, ...).</p>
		<select id="compact-mode-slider" rel="COMPACT_MODE" data-role="slider" class="preference-toggle">
			<option value="0" <?php if ($preferences['COMPACT_MODE'] == false) : ?>selected="selected"<?php endif; ?> >Off</option>
			<option value="1"  <?php if ($preferences['COMPACT_MODE'] == true) : ?>selected="selected"<?php endif; ?> >On</option>
		</select>
	</li>
	<li>
		<label>Show Hardcore Auction Houses</label>
		<p>Use this option to show and hide the Hardcore Auction Houses on the Auctions page.  Any data associated with those Auction Houses will still be retained!  This option merely hides them.</p>
		<select id="show-hardcore-slider" rel="SHOW_HARDCORE" data-role="slider" class="preference-toggle">
			<option value="0" <?php if ($preferences['SHOW_HARDCORE'] == false) : ?>selected="selected"<?php endif; ?> >Off</option>
			<option value="1"  <?php if ($preferences['SHOW_HARDCORE'] == true) : ?>selected="selected"<?php endif; ?> >On</option>
		</select>
	</li>
	<li>
		<label>Use ONLY My Auction Data for Market Suggestions</label>
		<p>When enabled, this will limit the sample of items for <b>Market Research</b> Suggestions to just the ones you have entered.</p>
		<select id="show-hardcore-slider" rel="USE_MY_DATA" data-role="slider" class="preference-toggle">
			<option value="0" <?php if ($preferences['USE_MY_DATA'] == false) : ?>selected="selected"<?php endif; ?> >Off</option>
			<option value="1"  <?php if ($preferences['USE_MY_DATA'] == true) : ?>selected="selected"<?php endif; ?> >On</option>
		</select>		
	</li>
	<li>
		<label>Show <b>Bought For</b> When Adding Auctions</label>
		<p>An optional field that will allow you to set the amount you paid for a particular item.  Will also show the difference between <b>Profit</b> and <b>Bought For</b> in the Item History and Auction Log.  Handy in the art of flipping items to keep track of actual profits!</p>
		<select id="bought-for-slider" rel="SHOW_BOUGHT_FOR" data-role="slider" class="preference-toggle">
			<option value="0" <?php if ($preferences['SHOW_BOUGHT_FOR'] == false) : ?>selected="selected"<?php endif; ?> >Off</option>
			<option value="1"  <?php if ($preferences['SHOW_BOUGHT_FOR'] == true) : ?>selected="selected"<?php endif; ?> >On</option>
		</select>
	</li>
	<li data-role="list-divider" class="divider-2">
		Comparison
	</li>
	<li>
		<label>Higher Limit of <b>Required Level</b> Range</label>
		<p>This slider allows you to set the higher limit for the <b>Required Level</b> range used in the application.</p>
		<p>For example, you have an item that is Required Level 45.  Setting this value to 5 will cause the app to consider all items with a Required Level between 45-50.</p>
		<p><em>Defaults to 1.  Setting this to a high value is not recommended!</em></p>
		<?php 
			$possible = array(
				'0' =>		'0',
				'1' =>		'1',
				'2' =>		'2',
				'3' =>		'3',
				'4' =>		'4',
				'5' =>		'5'
			);
		?>
		<select id="higher-level-slider" class="preference-toggle" rel="COMPARE_HIGHER_LEVEL">
			<?php foreach($possible as $value=>$label): ?>
				<option value="<?php echo $value; ?>" <?php if ($preferences['COMPARE_HIGHER_LEVEL'] == $value): ?>selected="selected"<?php endif; ?> ><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>
	</li>
	<li>
		<label>Lower Limit of <b>Required Level</b> Range</label>
		<p>This slider allows you to set the lower limit for the <b>Required Level</b> range used in the application.</p>
		<p>For example, you have an item that is Required Level 45.  Setting this value to 5 will cause the app to consider all items with a Required Level between 40-45.</p>
		<p><em>Defaults to 3.  Setting this to a high value is not recommended!</em></p>
		<?php 
			$possible = array(
				'0' =>		'0',
				'1' =>		'1',
				'2' =>		'2',
				'3' =>		'3',
				'4' =>		'4',
				'5' =>		'5'
			);
		?>	
		<select id="lower-level-slider" class="preference-toggle" rel="COMPARE_LOWER_LEVEL">
			<?php foreach($possible as $value=>$label): ?>
				<option value="<?php echo $value; ?>" <?php if ($preferences['COMPARE_LOWER_LEVEL'] == $value): ?>selected="selected"<?php endif; ?> ><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>		
	</li>
	<li>
		<label>Secondary Stat Comparison Range</label>
		<p>This slider allows you to set the <b>percentage (%)</b> decrease in the Secondary Stats when looking at the item's <b>Comparison Stats</b>.</p>
		<p>For example, you have an item that has 100 Dexterity.  Setting this value to 10% will cause the <b>Comparison Stats</b> to suggest searching for similar item's with at least 90 Dexterity.</p>
		<p><em>Defaults to 10%.  Setting this value lower or higher will decrease or increase the chances of finding reliable Buyout Prices in the Auction House.</em></p>
		<?php
			$possible = array(
				'0.05' => '5%',
				'0.10' => '10%',
				'0.15' => '15%',
				'0.20' => '20%',
				'0.25' => '25%',
				'0.30' => '30%',
				'0.35' => '35%',
				'0.40' => '40%',
				'0.45' => '45%',
				'0.50' => '50%'
			);
		?>
		<select id="stat-range-slider" class="preference-toggle" rel="COMPARE_STAT_RANGE">
			<?php foreach($possible as $value=>$label): ?>
				<option value="<?php echo $value; ?>" <?php if ($preferences['COMPARE_STAT_RANGE'] == $value): ?>selected="selected"<?php endif; ?> ><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>
	</li>
	<li data-role="list-divider" class="divider-2">
		Suggestions
	</li>
	<li>
		<label>Percent of Suggested Buyout as Bid</label>
		<p>This slider allows you to set how much of a Suggested <b>Buyout</b> you would like set as the <b>Bid</b>.</p>
		<p>For example, an item has a suggested buyout of 1000.  Setting this value to 50% will cause the <b>Bid</b> to autofill to 500.</p>
		<p><em>Defaults to 100%.</em></p>
		<?php
			$possible = array(
				'0.50' => '50%',
				'0.55' => '55%',
				'0.60' => '60%',
				'0.65' => '65%',
				'0.70' => '70%',
				'0.75' => '75%',
				'0.80' => '80%',
				'0.85' => '85%',
				'0.90' => '90%',
				'0.95' => '95%',
				'1.00' => '100%'
			);
		?>
		<select id="bid-percent-slider" class="preference-toggle" rel="SUGGEST_BID_PERCENT">
			<?php foreach($possible as $value=>$label): ?>
				<option value="<?php echo $value; ?>" <?php if ($preferences['SUGGEST_BID_PERCENT'] == $value): ?>selected="selected"<?php endif; ?> ><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>
	</li>
	<li data-role="list-divider" class="divider-2">
		Market Research
	</li>
	<li>
		<label>Stricter Filtering</label>
		<p>All <b>Market Research</b> Suggestions have filtering of potentially <em>bogus or invalid</em> data.  With <b>Stricter Filtering</b> enabled, you can make the <b>Bogus or Invalid Range</b> wider.</p>
		<p><em><b>Notice:</b></em> There is a greater chance that <em>good</em> results may fall into the <b>Bogus or Invalid Range</b> when enabled.</p>
		<select id="strict-filtering-slider" rel="SUGGEST_STRICTER_FILTER" data-role="slider" class="preference-toggle">
			<option value="0" <?php if ($preferences['SUGGEST_STRICTER_FILTER'] == false) : ?>selected="selected"<?php endif; ?> >Off</option>
			<option value="1"  <?php if ($preferences['SUGGEST_STRICTER_FILTER'] == true) : ?>selected="selected"<?php endif; ?> >On</option>
		</select>
	</li>
	<li>
		<label>Number of Similar Items Needed</label>
		<p>This selector allows you to set how many similar sales must be found for the <b>Market Research</b> Suggestion to be shown.</p>
		<p>For example, setting this to 5 would require at least 5 similar, <em>valid</em> sales be found before a <b>Market Research</b> Suggestion is made.</p>
		<p><em>Defaults to 3.</em></p>
		<?php
			$possible = array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10'
			);
		?>
		<select id="similars-required-slider" class="preference-toggle" rel="SUGGEST_SIMILARS_REQUIRED">
			<?php foreach($possible as $value=>$label): ?>
				<option value="<?php echo $value; ?>" <?php if ($preferences['SUGGEST_SIMILARS_REQUIRED'] == $value): ?>selected="selected"<?php endif; ?> ><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>
	</li>
	<li>
		<label>Similar Items' Stat Range</label>
		<p>This selector allows you to set how close an another item's Stats need to be to be considered a <b>Match</b> for the <b>Market Research</b> Suggestion.</p>
		<p>For example, you have a pair of boots with 100 Strength.  Setting this value to 10% will cause any boots with Strength in the range of 90 and 110 to be considered potential matches (there are other criteria).</p>
		<p><em>Defaults to 10%.</em></p>
		<?php
			$possible = array(
				'0.05' => '5%',
				'0.10' => '10%',
				'0.15' => '15%',
				'0.20' => '20%',
				'0.25' => '25%',
				'0.30' => '30%',
				'0.35' => '35%',
				'0.40' => '40%',
				'0.45' => '45%',
				'0.50' => '50%'
			);
		?>
		<select id="market-range-slider" class="preference-toggle" rel="SUGGEST_MARKET_RANGE">
			<?php foreach($possible as $value=>$label): ?>
				<option value="<?php echo $value; ?>" <?php if ($preferences['SUGGEST_MARKET_RANGE'] == $value): ?>selected="selected"<?php endif; ?> ><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>
	</li>
	<li>
		<label>Valid Similar Item Threshold</label>
		<p>If <b>Similar Items' Stat Range</b> (above) deals with <b>ONE Stat</b> versus another, <b>Valid Similar Item Threshold</b> deals with <b>ALL Stats</b> between both items.</p>
		<p>For example, you have a pair of gloves with 4 total Stats.  Setting this to 75% will require any other pair of gloves to have at least 3 of the 4 Secondary Stats on your item to be considered a match.</p>
		<p><em>Defaults to 75%.</em></p>
		<?php
			$possible = array(
				'0.50' => '50%',
				'0.55' => '55%',
				'0.60' => '60%',
				'0.65' => '65%',
				'0.70' => '70%',
				'0.75' => '75%',
				'0.80' => '80%',
				'0.85' => '85%',
				'0.90' => '90%',
				'0.95' => '95%',
				'1.00' => '100%'
			);
		?>
		<select id="similar-threshold-slider" class="preference-toggle" rel="SUGGEST_MATCH_THRESHOLD">
			<?php foreach($possible as $value=>$label): ?>
				<option value="<?php echo $value; ?>" <?php if ($preferences['SUGGEST_MATCH_THRESHOLD'] == $value): ?>selected="selected"<?php endif; ?> ><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>
	</li>
	<li data-role="list-divider" class="divider-2">
		Lowest Undercut
	</li>
	<li>
		<label>Lowest Buyout Undercut Percentage</label>
		<p>This selector allows you to set how high you want to undercut (percentage) the "Lowest Buyout" provided.</p>
		<p>For example, the Lowest Buyout for a similar item is 1000 Gold.  Setting this to 10% will cause the app to suggest a Lowest Undercut Buyout of 900.</p>
		<p><em>Defaults to 8%.</em></p>
		<?php
			$possible = array(
				'0.01' => '1%',
				'0.02' => '2%',
				'0.03' => '3%',
				'0.04' => '4%',
				'0.05' => '5%',
				'0.06' => '6%',
				'0.07' => '7%',
				'0.08' => '8%',
				'0.09' => '9%',
				'0.10' => '10%',
				'0.11' => '11%',
				'0.12' => '12%',
				'0.13' => '13%',
				'0.14' => '14%',
				'0.15' => '15%'
			);
		?>
		<select id="undercut-slider" class="preference-toggle" rel="SUGGEST_LOWEST_UNDERCUT">
			<?php foreach($possible as $value=>$label): ?>
				<option value="<?php echo $value; ?>" <?php if ($preferences['SUGGEST_LOWEST_UNDERCUT'] == $value): ?>selected="selected"<?php endif; ?> ><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>
	</li>
	<li data-role="list-divider" class="divider-2">
		Vendor Markup
	</li>
	<li>
		<label>Vendor Markup Multiplier</label>
		<p>This selector allows you to set the multiplier for the <b>Vendor Markup</b> Suggestion.</p>
		<p>For example, an item's <b>Sell Value</b> is 100.  Setting this to 5 will cause the app to suggest a Vendor Markup Suggestion of 500 when a <b>Lowest Buyout</b> is not given.</p>
		<p><em>Defaults to 2x.</em></p>
		<?php
			$possible = array(
				'1' => '1x',
				'2' => '2x',
				'3' => '3x',
				'4' => '4x',
				'5' => '5x',
				'6' => '6x',
				'7' => '7x',
				'8' => '8x',
				'9' => '9x',
				'10' => '10x'
			);
		?>
		<select id="markup-slider" class="preference-toggle" rel="SUGGEST_VENDOR_MARKUP">
			<?php foreach($possible as $value=>$label): ?>
				<option value="<?php echo $value; ?>" <?php if ($preferences['SUGGEST_VENDOR_MARKUP'] == $value): ?>selected="selected"<?php endif; ?> ><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>
	</li>
</ul>
