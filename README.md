# DiabloAH


#### What is DiabloAH?

DiabloAH is a Diablo 3 Mobile Companion app I developed for use with my iPad. Originally, I had intended it to be entirely private -- just a simple app that could help me with making successful auctions and providing features that Blizzard's native interface is woefully lacking.

Because Diablo 3 does not have an API for the AH, my application relies heavily on user-inputted information. Specific details about a particular item are requested and, in return for that, my application can offer useful Comparison Stats for pricing similar items on the official Auction House as well as offering various Bid/Buyout Suggestions based off multiple factors.

One of the strongest features of the application is the growing community behind it. The more users that provide information about their items and their sales, the more realiable suggestions my application can produce. Everybody contributes to the wealth of information and, through a continuously refined algorithm, my application can scan through successful auctions to find items similar to what you wish to offer and tell you what it might be worth.

I highly recommend using my app every time you open the Diablo 3 Auction House. It'll help keep things organized, provide fun information about your total sales and profits, and it might save you a few times from selling an item way below its worth.


#### Why the need for a Signup and Login?

I know, I know... it seems shady. Believe me, I had to explain myself in circles the need for a login page at all. Essentially it's due to database design - Users own Items and I need something to uniquely identify a User with. You can use whatever email address and password you want, bogus or not. I'm not going to use them or even test them.

As a matter of fact, I strongly request that you DO NOT use your BNet Account information at all. Seriously, use anything that looks like an email address and password. It just has to be unique and you have to remember it.


#### Does this connect with my BNet Account?

The simple answer is: No. Blizzard has not shown any intentions of opening up the AH to developers and any AH enhancements are certainly behind much more pressing issues on their end.

That said, it is fairly easy to incorporate my app in your Auction House routine. For example, I keep my iPad nearby and use the Sell Tab in the Auction House to show the tooltip for a particular item. I enter all the information into the app and return to the Auction House with some stats to search for a Lowest Buyout.

One of my biggest peeves with the current Auction House (and one of the reasons this application exists in any incarnation) is that the tooltip vanishes when the Diablo screen loses focus. So unless you've got a stellar memory or a piece of paper nearby, you'll have to switch back and forth between the Sell tab when looking up reasonable prices. You're welcome to see DiabloAH as just a glorified piece of paper with quite a few bells and whistles attached.


#### What guards do you have against bogus data?

Of course, the internet being the internet, there's always a chance that some user will decide to fill the database with completely bogus data.

I'm not too naive to think that everybody using the app will provide useful and accurate item information.

There is a setting on the Settings page that can provide some meaningful protection from the "trolls". It ensures all "Market Research" Suggestions are based off your data alone rather than the community's as a whole. While it can result in fewer "Market Research" Suggestions overall, it can at least continue to keep the app beneficial to you.

That's the short-term solution.

The long-term solution involves using basic statistics principles to identify the outliers (extreme points in a collection of data) and simply not include them. As the app becomes more powerful and collects much more data, I will look into refining the algorithms and including some "Troll Protection."
