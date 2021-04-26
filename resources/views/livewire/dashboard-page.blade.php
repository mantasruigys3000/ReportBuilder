<div class=" ">
   <h1 class="text-lg text-bold">Dashboard</h1>

    <div class="flex flex-wrap">
        <div class="w-full h-80">
            <h2>Average benefit quote each month </h2>
            <div>
                <div id="chart" class="h-80"></div>
            </div>
        </div>

        <div class="w-1/2">chart3
            <div>
                <div id="chart2" class="h-80"></div>
            </div>
        </div>
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
            url: "@chart('smoker_chart')",
            hooks: new ChartisanHooks().datasets([{type:'bar'}]),
        });
    </script>
</div>


