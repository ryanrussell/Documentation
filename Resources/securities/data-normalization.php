<?php
$getDataNormalizationText = function($isWritingAlgorithms)
{
    echo "<p>The data normalization mode defines how historical data is adjusted for <a href='/docs/v2/writing-algorithms/securities/asset-classes/us-equity/corporate-actions'>corporate actions</a>. ";
    if ($isWritingAlgorithms)
    {
        echo "The data normalization mode affects the data that LEAN passes to <code>OnData</code> and the data from <a href='/docs/v2/writing-algorithms/historical-data/history-requests'>history requests</a>. ";
    }
    echo "By default, LEAN adjusts US Equity data for splits and dividends to produce a smooth price curve, but the following data normalization modes are available:</p>
    
<div data-tree='QuantConnect.DataNormalizationMode' data-fields='Raw,Adjusted,SplitAdjusted,TotalReturn'></div>
";

    include(DOCS_RESOURCES."/datasets/data-normalization.php");
    echo $getDataNormalizationAdjustmentText($isWritingAlgorithms);

    $cVariableName = $isWritingAlgorithms ? "" : "qb." ;
    $pyVariableName = $isWritingAlgorithms ? "self" : "qb" ;
    $cAssignmentName = $isWritingAlgorithms ? "_symbol" : "var spy" ;
    $pyAssignmentName = $isWritingAlgorithms ? "self.symbol" : "spy" ;
    
    echo "
<p>To set the data normalization mode for a security, pass a <code>dataNormalizationMode</code> argument to the <code>AddEquity</code> method.</p>    

<div class='section-example-container'>
    <pre class='csharp'>{$cAssignmentName} = {$cVariableName}AddEquity(\"SPY\", dataNormalizationMode: DataNormalizationMode.Raw).Symbol;</pre>
    <pre class='python'>{$pyAssignmentName} = {$pyVariableName}.AddEquity(\"SPY\", dataNormalizationMode=DataNormalizationMode.Raw).Symbol</pre>
</div>

";
    if ($isWritingAlgorithms)
    {
        echo "
<p>To set the data normalization mode for all securities in an algorithm, set the <code>DataNormalizationMode</code> <a href='/docs/v2/writing-algorithms/universes/key-concepts#05-Universe-Settings'>universe setting</a> before you create the security subscriptions.</p>

 <div class='section-example-container'>
    <pre class='csharp'>UniverseSettings.DataNormalizationMode = DataNormalizationMode.Raw;</pre>
    <pre class='python'>self.UniverseSettings.DataNormalizationMode = DataNormalizationMode.Raw</pre>
</div>            
";
    }
}
?>
