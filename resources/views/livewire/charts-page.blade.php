<div class="bg-white">
    <div class="flex flex-wrap">
        <div wire:click="click('/viewchart/typecount')" class="w-1/2 hover:cursor-pointer hover:opacity-50">
            <div></div>
            <div id="chart3" class="h-80"></div>
            <script>
                const chart3 = new Chartisan({
                    el: '#chart3',
                    url: "@chart('quote_type_age_count')",
                    hooks: new ChartisanHooks().title('Amount of quotes made by each age group')
                });
            </script>
        </div>

        <div class="w-1/2">
            <div id="chart2" class="h-80"></div>
            <script>
                const chart2 = new Chartisan({
                    el: '#chart2',
                    url: "@chart('smoker_chart')",
                    hooks: new ChartisanHooks()
                        .tooltip(true)
                        .legend()
                });
            </script>
        </div>
    </div>
</div>
