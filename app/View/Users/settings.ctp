<?php $this->start('header'); ?>
	<h1>Settings</h1>
	<a href="/items" class="ui-btn-left" data-ajax="false" data-icon="arrow-l">Back</a>
<?php $this->end(); ?>

<ul data-role="listview">
	<li data-role="list-divider" class="divider-1">
		Preferences
	</li>
	<li data-role="list-divider" class="divider-2">
		General
	</li>
	<li>
		<label>Compact Mode</label>
		<p><b>Compact Mode</b> limits the Secondary Stat selection to a much smaller sample of "Core" Stats.  Disabling this feature will show all Secondary Stats for a particular Item Category (i.e. Class-Specific Stats, Resistance Types, Chance on Hit Types, ...).</p>
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
		<p>When enabled, this will limit the sample of items for "Market Research" Suggestions to just the ones you have entered.</p>
		<select id="show-hardcore-slider" rel="USE_MY_DATA" data-role="slider" class="preference-toggle">
			<option value="0" <?php if ($preferences['USE_MY_DATA'] == false) : ?>selected="selected"<?php endif; ?> >Off</option>
			<option value="1"  <?php if ($preferences['USE_MY_DATA'] == true) : ?>selected="selected"<?php endif; ?> >On</option>
		</select>		
	</li>
	<li>
		<label>Show "Bought For" When Adding Auctions</label>
		<p>An optional field that will allow you to set the amount you paid for a particular item.  Will also show the difference between "Profit" and "Bought For" in the Item History and Auction Log.  Handy in the art of flipping items to keep track of actual profits!</p>
		<select id="bought-for-slider" rel="SHOW_BOUGHT_FOR" data-role="slider" class="preference-toggle">
			<option value="0" <?php if ($preferences['SHOW_BOUGHT_FOR'] == false) : ?>selected="selected"<?php endif; ?> >Off</option>
			<option value="1"  <?php if ($preferences['SHOW_BOUGHT_FOR'] == true) : ?>selected="selected"<?php endif; ?> >On</option>
		</select>
	</li>
	<li data-role="list-divider" class="divider-2">
		Comparison
	</li>
	<li>
		<label>Higher Limit of "Required Level" Range</label>
		<p>This slider allows you to set the higher limit for the "Required Level" range used in the application.</p>
		<p>For example, you have an item that is Required Level 45.  Setting this value to 5 will cause the app to consider all items with a Required Level between 45-50.</p>
		<p><em>Defaults to 1.  Setting this to a high value is not recommended!</em></p>
		<input type="range" name="slider" id="higher-level-slider" class="preference-slider" rel="COMPARE_HIGHER_LEVEL" value="<?php echo $preferences['COMPARE_HIGHER_LEVEL']; ?>" min="0" max="20" data-highlight="true" />
		<div>
			<a href="javascript:;" class="save-preference" data-role="button" data-icon="check">Save</a>
		</div>
	</li>
	<li>
		<label>Lower Limit of "Required Level" Range</label>
		<p>This slider allows you to set the lower limit for the "Required Level" range used in the application.</p>
		<p>For example, you have an item that is Required Level 45.  Setting this value to 5 will cause the app to consider all items with a Required Level between 40-45.</p>
		<p><em>Defaults to 3.  Setting this to a high value is not recommended!</em></p>
		<input type="range" name="slider" id="lower-level-slider" class="preference-slider" rel="COMPARE_LOWER_LEVEL" value="<?php echo $preferences['COMPARE_LOWER_LEVEL']; ?>" min="0" max="20" data-highlight="true" />	
		<div>
			<a href="javascript:;" class="save-preference" data-role="button" data-icon="check">Save</a>
		</div>
	</li>
	<li>
		<label>Secondary Stat Comparison Range</label>
		<p>This slider allows you to set the <b>percentage (%)</b> decrease in the Secondary Stats when looking at the item's Comparison info.</p>
		<p>For example, you have an item that has 100 Dexterity.  Setting this value to 10(%) will cause the Comparison info to suggest searching for similar item's with at least 90 Dexterity.</p>
		<p><em>Defaults to 10%.  Setting this value lower or higher will decrease or increase the chances of finding reliable Buyout Prices in the Auction House.</em></p>
		<input type="range" name="slider" id="stat-range-slider" class="preference-slider percentage" rel="COMPARE_STAT_RANGE" value="<?php echo $preferences['COMPARE_STAT_RANGE'] * 100; ?>" min="0" max="50" data-highlight="true" />		
		<div>
			<a href="javascript:;" class="save-preference" data-role="button" data-icon="check">Save</a>
		</div>
	</li>
	<li data-role="list-divider" class="divider-2">
		Suggestions
	</li>
	<li>
		<label>Market Research - Similar Items' Stat Range</label>
		<p>This slider allows you to set how close an another item's Stats need to be to be considered a <b>Match</b> for the "Market Research" Suggestion.</p>
		<p>For example, you have a pair of boots with 100 Strength.  Setting this value to 10(%) will cause any boots with Strength in the range of 90 and 110 to be considered potential matches (there are other criteria).</p>
		<p><em>Defaults to 10%.  Setting this value lower or higher will decrease or increase the likelihood of "Market Research" finding potential matches.</em></p>
		<input type="range" name="slider" id="market-range-slider" class="preference-slider percentage" rel="SUGGEST_MARKET_RANGE" value="<?php echo $preferences['SUGGEST_MARKET_RANGE'] * 100; ?>" min="0" max="50" data-highlight="true" />				
		<div>
			<a href="javascript:;" class="save-preference" data-role="button" data-icon="check">Save</a>
		</div>
	</li>
	<li>
		<label>Lowest Undercut - Lowest Buyout Undercut Percentage</label>
		<p>This slider allows you to set how high you want to undercut (percentage) the "Lowest Buyout" provided.</p>
		<p>For example, the Lowest Buyout for a similar item is 1000 Gold.  Setting this to 10% will cause the app to suggest a Lowest Undercut Bid/Buyout of 900.</p>
		<p><em>Defaults to 8%.</em></p>
		<input type="range" name="slider" id="undercut-slider" class="preference-slider percentage" rel="SUGGEST_LOWEST_UNDERCUT" value="<?php echo $preferences['SUGGEST_LOWEST_UNDERCUT'] * 100; ?>" min="0" max="50" data-highlight="true" />				
		<div>
			<a href="javascript:;" class="save-preference" data-role="button" data-icon="check">Save</a>
		</div>
	</li>
	<li>
		<label>Vendor Markup - Vendor Markup Multiplier</label>
		<p>This slider allows you to set the multiplier for the Vendor Markup Suggestion.</p>
		<p>For example, an item's Sell Value is 100.  Setting this to 5 will cause the app to suggest a Vendor Markup Suggestion of 500.</p>
		<p><em>Defaults to 2.</em></p>
		<input type="range" name="slider" id="markup-slider" class="preference-slider" rel="SUGGEST_VENDOR_MARKUP" value="<?php echo $preferences['SUGGEST_VENDOR_MARKUP']; ?>" min="1" max="10" data-highlight="true" />				
		<div>
			<a href="javascript:;" class="save-preference" data-role="button" data-icon="check">Save</a>
		</div>
	</li>
</ul>
