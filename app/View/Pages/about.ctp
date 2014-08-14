<?php $this->start('header'); ?>
	<h1>About DiabloAH</h1>
	<a href="#" data-rel="back" class="ui-button-left" data-icon="arrow-l" data-iconpos="left">Back</a>
<?php $this->end(); ?>

<a href="/pages/updates" data-role="button" data-icon="star">Latest Updates</a>

<h1>What is DiabloAH?</h1>
<p>
<b>DiabloAH</b> is a Diablo 3 Mobile Companion app I developed for use with my iPad.  Originally, I had intended it to be entirely private -- just a simple app that could help me with making successful auctions and providing features that Blizzard's native interface is woefully lacking.
</p>
<p>
<b>Because Diablo 3 does not have an API for the AH</b>, my application relies heavily on user-inputted information.  Specific details about a particular item are requested and, in return for that, my application can offer useful <b>Comparison Stats</b> for pricing similar items on the official Auction House as well as offering various <b>Bid/Buyout Suggestions</b> based off multiple factors.</p>
</p>
<p>
One of the strongest features of the application is the growing community behind it.  The more users that provide information about their items and their sales, the more realiable suggestions my application can produce.  Everybody contributes to the wealth of information and, through a continuously refined algorithm, my application can scan through successful auctions to find items similar to what you wish to offer and tell you what it might be worth.
</p>
<p>
I highly recommend using my app every time you open the Diablo 3 Auction House.  It'll help keep things organized, provide fun information about your total sales and profits, and it <em>might</em> save you a few times from selling an item way below its worth.
</p>

<h1>Why the need for a Signup and Login?</h1>
<p>
I know, I know... it seems shady.  Believe me, I had to explain myself in circles the need for a login page at all.  Essentially it's due to <b>database design</b> - <b>Users</b> own <b>Items</b> and I need <em>something</em> to uniquely identify a <b>User</b> with.  You can use whatever username and password you want.
</p>
<p>
<em>As a matter of fact, I strongly request that you <b>DO NOT</b> use your Battle.Net Account information at all.</em>  Seriously, use whatever username and password combination you want.
</p>

<h1>Does this connect with my Battle.Net Account?</h1>
<p>
The simple answer is: <b>No</b>.  Blizzard has not shown any intentions of opening up the AH to developers and any AH enhancements are certainly behind much more pressing issues on their end.
</p>
<p>
That said, it is fairly easy to incorporate my app in your Auction House routine.  For example, I keep my iPad nearby and use the Sell Tab in the Auction House to show the tooltip for a particular item.  I enter all the information into the app and return to the Auction House with some stats to search for a Lowest Buyout.
</p>
<p>
One of my biggest peeves with the current Auction House (and one of the reasons this application exists in any incarnation) is that the tooltip vanishes when the Diablo screen loses focus.  So unless you've got a stellar memory or a piece of paper nearby, you'll have to switch back and forth between the Sell tab when looking up reasonable prices.  You're welcome to see <b>DiabloAH</b> as just a glorified piece of paper with quite a few bells and whistles attached.
</p>

<h1>What guards do you have against bogus data?</h1>
<p>Of course, the internet being the internet, there's always a chance that some user will decide to fill the database with completely bogus data.</p>
<p>I'm not too naive to think that everybody using the app will provide useful and accurate item information.</p>
<p>There is a setting on the <b>Settings</b> page that can provide some meaningful protection from the "trolls".  It ensures all "Market Research" Suggestions are based off your data alone rather than the community's as a whole.  While it can result in fewer "Market Research" Suggestions overall, it can at least continue to keep the app beneficial to you.</p>
<p>That's the short-term solution.</p>
<p>The long-term solution involves using basic statistics principles to identify the outliers (extreme points in a collection of data) and simply not include them.  As the app becomes more powerful and collects much more data, I will look into refining the algorithms and including some "Troll Protection."</p>

<h1>Help!  I found a bug!</h1>
<p>Well, first let me apologize and hopefully it hasn't caused too much harm.  This project is still in "beta" and I'm still actively squashing bugs and adding features (features that sometimes break other features, unfortunately).</p>
<p>If you want to get ahold of me concerning a bug (and you definitely should), there's a few locations I check regularly:</p>
<p>
<a href="http://www.reddit.com">Reddit</a>, you can send a private message to <a href="http://www.reddit.com/user/functioning/" target="_blank">functioning</a><br />
<a href="https://github.com/Enigmatical/diabloah">GitHub</a>, periodically updated, and you're welcome to open an <a href="https://github.com/Enigmatical/diabloah/issues?state=open" target="_blank">Issue</a>
</p>

<h1>Screenshots</h1>
<a href="http://diabloah.developingwithdavis.com/img/screenshots/gold_auctions.PNG" target="_blank">Your Auctions</a>
<p>
This is the first screen you arrive at immediately after signing up or logging in.  This is the "hub" for the entire application.  Across the top are tabs for the <b>Gold Auction House</b>, the <b>Real Money Auction House</b>, and an overall <b>Auction Log</b> of all your activity on DiabloAH.
</p>
<a href="http://diabloah.developingwithdavis.com/img/screenshots/add_auction.PNG" target="_blank">Adding an Auction</a>
<p>
Yes, it can be a really intimidating form.  Just keep thinking "Glorified Piece of Paper."  I highly recommend starting at the top and working your way down, providing all information you can.  You'll notice you can add <b>more than 3 Secondary Stats</b>.  <b>All Stats</b> will be taken into consideration when searching for similar items for the "Market Research" suggestion (something the offical Auction House cannot do).
</p>
<a href="http://diabloah.developingwithdavis.com/img/screenshots/auction_with_suggestions.PNG" target="_blank">Bid/Buyout Suggestions</a>
<p>
Speaking of suggestions, once you have provided as much information as you can about an item, you'll want to press the "Compute" button.  The app will then look at the item, look for similar items others have sold, and provide some <b>meaningful Bid/Buyout Suggestions</b>.
</p>
<a href="http://diabloah.developingwithdavis.com/img/screenshots/view_auction.PNG" target="_blank">Viewing an Auction</a><br />
<a href="http://diabloah.developingwithdavis.com/img/screenshots/unsold_auction_with_history.PNG" target="_blank">Viewing an Auction 2</a><br />
<a href="http://diabloah.developingwithdavis.com/img/screenshots/auction_with_log.PNG" target="_blank">Viewing an Auction 3</a>
<p>
Once you've created the Auction, you can view it at any time by pressing on it.  This page can have various actions such as <b>Mark the Auction as Successful!</b>, <b>Update the Auction with new Bid/Buyout Prices</b>, and <b>Remove the Auction</b>.  All of these actions will be recorded in the Item's History as well as the Auctions Log.
</p>
<a href="http://diabloah.developingwithdavis.com/img/screenshots/log_auctions.PNG" target="_blank">The Auction Log</a>
<p>
This tab will keep a running history of all the actions you have made in DiabloAH.  Clicking on any action will take you to the item (even if it has already been sold or removed).
</p>
<a href="http://diabloah.developingwithdavis.com/img/screenshots/settings.PNG" target="_blank">Settings</a>
<p>
Finally, once you've grown comfortable with the application (and potentially have a few successful sales under your belt), you can dig into the Settings menu to further refine your experience and tailor the Bid/Buyout Suggestions to fit your goals.
</p>