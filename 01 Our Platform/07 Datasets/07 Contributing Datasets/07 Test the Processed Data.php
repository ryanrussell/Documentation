<p>You must set up unit tests for your dataset before you test the processed data.</p>

<p>Follow these steps to test if your demonstration algorithm will run in production with the processed data:</p>

<ol>
    <li>Copy the contents of the <span class='private-file-name'>Lean.DataSource.&lt;vendorNameDatasetName&gt;/output</span> directory and paste them into the <span class='private-directory-name'>Lean/Data</span> directory.</li>
    <li>Copy the <span class='private-file-name'>Lean.DataSource.&lt;vendorNameDatasetName&gt;/&lt;vendorNameDatasetName&gt;Algorithm.cs</span> file and paste it in the <span class='private-file-name'>Lean/Algorithm.CSharp</span> directory. </li>
    <li>Open the <span class='private-file-name'>Lean.DataSource.&lt;vendorNameDatasetName&gt;/QuantConnect.DataSource.csproj</span> file in Visual Studio.</li>
    <li>In the top menu bar of Visual Studio, click <span class='menu-name'>Build > Build Solution</span>.</li>
    <p>The Output panel displays the build status of the project.</p>
    <li>Close Visual Studio.</li>
    <li>Open the <span class='private-file-name'>Lean/QuantConnect.Lean.sln</span> file in Visual Studio.</li>
    <li>In the Solution Explorer panel of Visual Studio, right-click <span class='private-file-name'>QuantConnect.Algorithm.CSharp</span> and then click <span class='menu-name'>Add > Existing Item…</span>.</li>
    <li>In the Add Existing Item window, click the <span class='private-file-name'>Lean.DataSource.&lt;vendorNameDatasetName&gt;/&lt;vendorNameDatasetName&gt;Algorithm.cs</span> file and then click Add.</li>
    <li>In the Solution Explorer panel, right-click <span class='private-file-name'>QuantConnect.Algorithm.CSharp</span> and then click <span class='menu-name'>Add > Project Reference...</span>.</li>
    <li>In the Reference Manager window, click <span class='button-name'>Browse…</span>.</li>
    <li>In the Select the files to reference… window, click the <span class='private-file-name'>Lean.DataSource.&lt;vendorNameDatasetName&gt;/bin/Debug/net6.0/QuantConnect.DataSource.&lt;vendorNameDatasetName&gt;.dll</span> file and then click <span class='button-name'>Add</span>.</li>
    <p>The Reference Manager window displays the <span class='private-file-name'>QuantConnect.DataSource.&lt;vendorNameDatasetName&gt;.dll</span> file with the check box beside it enabled.</p>
    <li>Click <span class='button-name'>OK</span>.</li>
    <p>The Solution Explorer panel adds the <span class='private-file-name'>QuantConnect.DataSource.&lt;vendorNameDatasetName&gt;.dll</span> file under <span class='menu-name'>QuantConnect.Algorithm.CSharp > Dependencies > Assemblies</span>.</p>
    <li>In the Solution Explorer panel, click <span class='private-file-name'>QuantConnect.Lean.Launcher > config.json</span>.</li>
    <li>In the <span class='private-file-name'>config.json</span> file, replace</li>
    <div class="section-example-container">
        <pre>"algorithm-type-name": "BasicTemplateFrameworkAlgorithm",</pre>
    </div>
    <p>with</p>
    <div class="section-example-container">
        <pre>"algorithm-type-name": "&lt;vendorNameDatasetName&gt;Algorithm”,</pre>
    </div>
    <p>For example:</p>
    <div class="section-example-container">
        <pre>"algorithm-type-name": “XYZAirlineTicketSalesAlgorithm”,</pre>
    </div>
    <li>Press <span class='key-combinations'>F5</span> to backtest your demonstration algorithm.</li>
    <p>Your backtest must run without error. If your backtest produces errors, correct them and then run the backtest again. Once the backtest is successful, continue on to the succeeding steps to test your demonstration algorithm in live mode.</p>
    <li>In the <span class='private-file-name'>config.json</span> file, replace</li>
    <div class="section-example-container">
        <pre>"environment": "backtesting",</pre>
    </div>
    <p>with</p>
    <div class="section-example-container">
        <pre>"environment": "live-paper",</pre>
    </div>
    <p>and replace</p>
    <div class="section-example-container">
        <pre>"data-provider": "QuantConnect.Lean.Engine.DataFeeds.DefaultDataProvider",</pre>
    </div>
    <p>with</p>
    <div class="section-example-container">
        <pre>"data-provider": "QuantConnect.Lean.Engine.DataFeeds.FakeDataQueue",</pre>
    </div>
    <li>Press <span class='key-combinations'>F5</span> to run your demonstration algorithm in live mode.</li>
    <li>Add a dummy entry to the bottom of a data file in your <span class='private-file-name'>Lean.DataSource.&lt;vendorNameDatasetName&gt;/output</span> directory and then save the file.</li>
    <li>Check if the data point that you added in the previous step is injected into your demonstration algorithm through the <code>OnData</code> method.</li>
    <p>If the <code>OnData</code> method receives the new data point, your algorithm works in live mode.</p>
    <p>You may need to wait for the new data point to be polled before it is injected into your algorithm. Lean polls for new data at various intervals, depending on the resolution of the data. The following table shows the polling frequency of each resolution:</p>

    <?php include(DOCS_RESOURCES."/datasets/live-dataset-polling-frequency-table.html"); ?>

</ol>
