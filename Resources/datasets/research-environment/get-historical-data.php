<?php
$getHistoricalDataText = function($createSubscriptionsLink, $assetClass, $underlyingSymbolVariable, $underlyingAssetClass)
{
    echo "
<p>You need a <a href='{$createSubscriptionsLink}'>subscription</a> before you can request historical data for {$assetClass} contracts. On the time dimension, you can request an amount of historical data based on a trailing number of bars, a trailing period of time, or a defined period of time. On the contract dimension, you can request historical data for a single contract, a subset of the contracts you created subscriptions for in your notebook, or all of the contracts in your notebook.</p>

<p>Before you request historical data, call the <code>SetStartDate</code> method with a <code class='python'>datetime</code><code class='csharp'>DateTime </code> to reduce the risk of <a href='/docs/v2/writing-algorithms/key-concepts/glossary#16-look-ahead-bias'>look-ahead bias</a>.</p>
<div class='section-example-container'>
    <pre class='csharp'>qb.SetStartDate(startDate);</pre>
    <pre class='python'>qb.SetStartDate(start_date)</pre>
</div>
<p>If you call the <code>SetStartDate</code> method, the date that you pass to the method is the latest date for which your history requests will return data.<br></p>

<h4>Trailing Number of Bars<br></h4>
<p>To get historical data for a number of trailing bars, call the <code>History</code> method with the contract <code>Symbol</code> object(s) and an integer.</p>
<div class='section-example-container'>
    <pre class='csharp'>// Slice objects
var singleHistorySlice = qb.History(contractSymbol, 10);
var subsetHistorySlice = qb.History(new[] {contractSymbol}, 10);
var allHistorySlice = qb.History(10);

// TradeBar objects
var singleHistoryTradeBars = qb.History&lt;TradeBar&gt;(contractSymbol, 10);
var subsetHistoryTradeBars = qb.History&lt;TradeBar&gt;(new[] {contractSymbol}, 10);
var allHistoryTradeBars = qb.History&lt;TradeBar&gt;(qb.Securities.Keys, 10);

// QuoteBar objects
var singleHistoryQuoteBars = qb.History&lt;QuoteBar&gt;(contractSymbol, 10);
var subsetHistoryQuoteBars = qb.History&lt;QuoteBar&gt;(new[] {contractSymbol}, 10);
var allHistoryQuoteBars = qb.History&lt;QuoteBar&gt;(qb.Securities.Keys, 10);

// OpenInterest objects
var singleHistoryOpenInterest = qb.History&lt;OpenInterest&gt;(contractSymbol, 400);
var subsetHistoryOpenInterest = qb.History&lt;OpenInterest&gt;(new[] {contractSymbol}, 400);
var allHistoryOpenInterest = qb.History&lt;OpenInterest&gt;(qb.Securities.Keys, 400);</pre>
    <pre class='python'># DataFrame of trade and quote data
single_history_df = qb.History(contract_symbol, 10)
subset_history_df = qb.History([contract_symbol], 10)
all_history_df = qb.History(qb.Securities.Keys, 10)

# DataFrame of trade data
single_history_trade_bar_df = qb.History(TradeBar, contract_symbol, 10)
subset_history_trade_bar_df = qb.History(TradeBar, [contract_symbol], 10)
all_history_trade_bar_df = qb.History(TradeBar, qb.Securities.Keys, 10)

# DataFrame of open interest data
single_history_open_interest_df = qb.History(OpenInterest, contract_symbol, 400)
subset_history_open_interest_df = qb.History(OpenInterest, [contract_symbol], 400)
all_history_open_interest_df = qb.History(OpenInterest, qb.Securities.Keys, 400)

# Slice objects
all_history_slice = qb.History(10)

# TradeBar objects
single_history_trade_bars = qb.History[TradeBar](contract_symbol, 10)<br>subset_history_trade_bars = qb.History[TradeBar]([contract_symbol], 10)<br>all_history_trade_bars = qb.History[TradeBar](qb.Securities.Keys, 10)

# QuoteBar objects
single_history_quote_bars = qb.History[QuoteBar](contract_symbol, 10)
subset_history_quote_bars = qb.History[QuoteBar]([contract_symbol], 10)
all_history_quote_bars = qb.History[QuoteBar](qb.Securities.Keys, 10)

# OpenInterest objects
single_history_open_interest = qb.History[OpenInterest](contract_symbol, 400)
subset_history_open_interest = qb.History[OpenInterest]([contract_symbol], 400)
all_history_open_interest = qb.History[OpenInterest](qb.Securities.Keys, 400)</pre>
</div>
<p>The preceding calls return the most recent bars, excluding periods of time when the exchange was closed.</p>

    ";

    if ($assetClass == "Futures")
    {
        echo "<p>To get historical data for the continous Futures contract, in the preceding history requests, replace <code class='python'>contract_symbol</code><code class='csharp'>contractSymbol</code> with <code>future.Symbol</code>.</p>";
    }

    echo "
<h4>Trailing Period of Time<br></h4>
<p>To get historical data for a trailing period of time, call the <code>History</code> method with the contract <code>Symbol</code> object(s) and a <code class='csharp'>TimeSpan</code><code class='python'>timedelta</code>.</p>
<div class='section-example-container'>
    <pre class='csharp'>// Slice objects
var singleHistorySlice = qb.History(contractSymbol, TimeSpan.FromDays(3));
var subsetHistorySlice = qb.History(new[] {contractSymbol}, TimeSpan.FromDays(3));<br>var allHistorySlice = qb.History(10);

// TradeBar objects
var singleHistoryTradeBars = qb.History&lt;TradeBar&gt;(contractSymbol, TimeSpan.FromDays(3));<br>var subsetHistoryTradeBars = qb.History&lt;TradeBar&gt;(new[] {contractSymbol}, TimeSpan.FromDays(3));<br>var allHistoryTradeBars = qb.History&lt;TradeBar&gt;(TimeSpan.FromDays(3));

// QuoteBar objects
var singleHistoryQuoteBars = qb.History&lt;QuoteBar&gt;(contractSymbol, TimeSpan.FromDays(3), Resolution.Minute);<br>var subsetHistoryQuoteBars = qb.History&lt;QuoteBar&gt;(new[] {contractSymbol}, TimeSpan.FromDays(3), Resolution.Minute);<br>var allHistoryQuoteBars = qb.History&lt;QuoteBar&gt;(qb.Securities.Keys, TimeSpan.FromDays(3), Resolution.Minute);

// OpenInterest objects
var singleHistoryOpenInterest = qb.History&lt;OpenInterest&gt;(contractSymbol, TimeSpan.FromDays(2));
var subsetHistoryOpenInterest = qb.History&lt;OpenInterest&gt;(new[] {contractSymbol}, TimeSpan.FromDays(2));
var allHistoryOpenInterest = qb.History&lt;OpenInterest&gt;(qb.Securities.Keys, TimeSpan.FromDays(2));</pre>
    <pre class='python'># DataFrame of trade and quote data
single_history_df = qb.History(contract_symbol, timedelta(days=3))
subset_history_df = qb.History([contract_symbol], timedelta(days=3))
all_history_df = qb.History(qb.Securities.Keys, timedelta(days=3))

# DataFrame of trade data
single_history_trade_bar_df = qb.History(TradeBar, contract_symbol, timedelta(days=3))
subset_history_trade_bar_df = qb.History(TradeBar, [contract_symbol], timedelta(days=3))
all_history_trade_bar_df = qb.History(TradeBar, qb.Securities.Keys, timedelta(days=3))

# DataFrame of open interest data
single_history_open_interest_df = qb.History(OpenInterest, contract_symbol, timedelta(days=3))
subset_history_open_interest_df = qb.History(OpenInterest, [contract_symbol], timedelta(days=3))
all_history_open_interest_df = qb.History(OpenInterest, qb.Securities.Keys, timedelta(days=3))

# Slice objects
all_history_slice = qb.History(timedelta(days=3))

# TradeBar objects
single_history_trade_bars = qb.History[TradeBar](contract_symbol, timedelta(days=3))
subset_history_trade_bars = qb.History[TradeBar]([contract_symbol], timedelta(days=3))
all_history_trade_bars = qb.History[TradeBar](qb.Securities.Keys, timedelta(days=3))

# QuoteBar objects
single_history_quote_bars = qb.History[QuoteBar](contract_symbol, timedelta(days=3), Resolution.Minute)
subset_history_quote_bars = qb.History[QuoteBar]([contract_symbol], timedelta(days=3), Resolution.Minute)
all_history_quote_bars = qb.History[QuoteBar](qb.Securities.Keys, timedelta(days=3), Resolution.Minute)

# OpenInterest objects
single_history_open_interest = qb.History[OpenInterest](contract_symbol, timedelta(days=2))
subset_history_open_interest = qb.History[OpenInterest]([contract_symbol], timedelta(days=2))
all_history_open_interest = qb.History[OpenInterest](qb.Securities.Keys, timedelta(days=2))<br></pre>
</div>
<p>The preceding calls return the most recent bars, excluding periods of time when the exchange was closed.</p>
    ";

    if ($assetClass == "Futures")
    {
        echo "<p>To get historical data for the continous Futures contract, in the preceding history requests, replace <code class='python'>contract_symbol</code><code class='csharp'>contractSymbol</code> with <code>future.Symbol</code>.</p>";
    }

    echo "
<h4>Defined Period of Time<br></h4>
<p>To get historical data for individual {$assetClass} contracts during a specific period of time, call the <code>History</code> method with the {$assetClass} contract <code>Symbol</code> object(s), a start  <code class='csharp'>DateTime</code><code class='python'>datetime</code>, and an end <code class='csharp'>DateTime</code><code class='python'>datetime</code>.</p>

<div class='section-example-container'>
    <pre class='csharp'>var startTime = new DateTime(2021, 12, 1);
var endTime = new DateTime(2021, 12, 31);

// Slice objects
var singleHistorySlice = qb.History(contractSymbol, startTime, endTime);
var subsetHistorySlice = qb.History(new[] {contractSymbol}, startTime, endTime);
var allHistorySlice = qb.History(startTime, endTime);

// TradeBar objects
var singleHistoryTradeBars = qb.History&lt;TradeBar&gt;(contractSymbol, startTime, endTime);
var subsetHistoryTradeBars = qb.History&lt;TradeBar&gt;(new[] {contractSymbol}, startTime, endTime);
var allHistoryTradeBars = qb.History&lt;TradeBar&gt;(qb.Securities.Keys, startTime, endTime);

// QuoteBar objects
var singleHistoryQuoteBars = qb.History&lt;QuoteBar&gt;(contractSymbol, startTime, endTime, Resolution.Minute);
var subsetHistoryQuoteBars = qb.History&lt;QuoteBar&gt;(new[] {contractSymbol}, startTime, endTime, Resolution.Minute);
var allHistoryQuoteBars = qb.History&lt;QuoteBar&gt;(qb.Securities.Keys, startTime, endTime, Resolution.Minute);

// OpenInterest objects
var singleHistoryOpenInterest = qb.History&lt;OpenInterest&gt;(contractSymbol, startTime, endTime);
var subsetHistoryOpenInterest = qb.History&lt;OpenInterest&gt;(new[] {contractSymbol}, startTime, endTime);
var allHistoryOpenInterest = qb.History&lt;OpenInterest&gt;(qb.Securities.Keys, startTime, endTime);</pre>
    <pre class='python'>start_time = datetime(2021, 12, 1)
end_time = datetime(2021, 12, 31)

# DataFrame of trade and quote data
single_history_df = qb.History(contract_symbol, start_time, end_time)
subset_history_df = qb.History([contract_symbol], start_time, end_time)
all_history_df = qb.History(qb.Securities.Keys, start_time, end_time)

# DataFrame of trade data
single_history_trade_bar_df = qb.History(TradeBar, contract_symbol, start_time, end_time)
subset_history_trade_bar_df = qb.History(TradeBar, [contract_symbol], start_time, end_time)
all_history_trade_bar_df = qb.History(TradeBar, qb.Securities.Keys, start_time, end_time)

# DataFrame of open interest data
single_history_open_interest_df = qb.History(OpenInterest, contract_symbol, start_time, end_time)
subset_history_open_interest_df = qb.History(OpenInterest, [contract_symbol], start_time, end_time)
all_history_trade_open_interest_df = qb.History(OpenInterest, qb.Securities.Keys, start_time, end_time)

# Slice objects
all_history_slice = qb.History(start_time, end_time)

# TradeBar objects
single_history_trade_bars = qb.History[TradeBar](contract_symbol, start_time, end_time)
subset_history_trade_bars = qb.History[TradeBar]([contract_symbol], start_time, end_time)
all_history_trade_bars = qb.History[TradeBar](qb.Securities.Keys, start_time, end_time)

# QuoteBar objects
single_history_quote_bars = qb.History[QuoteBar](contract_symbol, start_time, end_time, Resolution.Minute)
subset_history_quote_bars = qb.History[QuoteBar]([contract_symbol], start_time, end_time, Resolution.Minute)
all_history_quote_bars = qb.History[QuoteBar](qb.Securities.Keys, start_time, end_time, Resolution.Minute)

# OpenInterest objects
single_history_open_interest = qb.History[OpenInterest](contract_symbol, start_time, end_time)
subset_history_open_interest = qb.History[OpenInterest]([contract_symbol], start_time, end_time)
all_history_open_interest = qb.History[OpenInterest](qb.Securities.Keys, start_time, end_time)<br></pre>
</div>
    ";

    if ($assetClass == "Futures")
    {
        echo "
<p>To get historical data for the continous Futures contract, in the preceding history requests, replace <code class='python'>contract_symbol</code><code class='csharp'>contractSymbol</code> with <code>future.Symbol</code>.</p>

<p class='python'>To get historical data for all of the {$assetClass} contracts that pass your <a href='{$createSubscriptionsLink}'>filter</a> during a specific period of time, call the <code>GetFutureHistory</code> method with the <code>Symbol</code> object of the continuous Future, a start <code class='csharp'>DateTime</code><code class='python'>datetime</code>, and an end <code class='csharp'>DateTime</code><code class='python'>datetime</code>.</p>

<div class='python section-example-container'>
    <pre class='python'>future_history = qb.GetFutureHistory({$underlyingSymbolVariable}, end_time-timedelta(days=2), end_time, Resolution.Minute, fillForward=False, extendedMarket=False)</pre>
</div>

        ";
    }
    else 
    {
        echo "
<p class='python'>To get historical data for all of the {$assetClass} contracts that pass your <a href='{$createSubscriptionsLink}'>filter</a> during a specific period of time, call the <code>GetOptionHistory</code> method with the underlying {$underlyingAssetClass} <code>Symbol</code> object, a start <code class='csharp'>DateTime</code><code class='python'>datetime</code>, and an end <code class='csharp'>DateTime</code><code class='python'>datetime</code>.</p>

<div class='python section-example-container'>
    <pre class='python'>option_history = qb.GetOptionHistory({$underlyingSymbolVariable}, end_time-timedelta(days=2), end_time, Resolution.Minute, fillForward=False, extendedMarket=False)</pre>
</div>
        ";
    }

    echo "
<p>The preceding calls return data that have a timestamp within the defined period of time.</p>
    ";
}


?>
