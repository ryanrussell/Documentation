<?php echo file_get_contents(DOCS_RESOURCES."/securities/resolutions/index-options.html"); ?>


<p>The default resolution for Index Option subscriptions is <code>Resolution.Minute</code>. To change the resolution, pass a <code>resolution</code> argument to the <code>AddIndexOptionContract</code> method.</p>


<div class="section-example-container">
    <pre class="csharp">AddIndexOptionContract(_contractSymbol, Resolution.Hour);</pre>
    <pre class="python">self.AddIndexOptionContract(self.contract_symbol, Resolution.Hour)</pre>
</div>

<p>To create custom resolution periods, see <a href="/docs/v2/writing-algorithms/consolidating-data/key-concepts">Consolidating Data</a>.</p>