<div class=" ">




   <h1>Dashboard</h1>

    <div class="flex flex-wrap">
        <div class="w-1/2">
            <h2>Chart 1</h2>
            <div>
                <div id="chart" class="h-40">

                </div>
            </div>
        </div>
        <div class="w-1/2">
            <h2>Chart 2</h2>
            <div>
                <div id="chart2" class="h-40">

                </div>
            </div>
        </div>
        <div class="w-1/2">chart3</div>
        <div class="w-1/2">chart4</div>
    </div>

    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('test_chart')",
            hooks: new ChartisanHooks().datasets([{type:'line'}]),
        });

        const chart2 = new Chartisan({
            el: '#chart2',
            url: "@chart('test_chart')",
            hooks: new ChartisanHooks().datasets([{type:'line'}]),
        });
    </script>
</div>


