<div class="bg-white">
    <div class="flex flex-wrap">
        <div wire:click="click('/viewchart/typecount')" class="w-1/2 hover:cursor-pointer hover:opacity-50">
            <div></div>
            <div id="chart3" class="h-80"></div>
            <script>
                const chart3 = new Chartisan({
                    el: '#chart3',
                    url: "@chart('quote_type_age_count')",
                    hooks: new ChartisanHooks().title('Type of coverage quoted for by each age group')
                });
            </script>
        </div>

        <div wire:click="click('/viewchart/ageovertime')" class="w-1/2 hover:cursor-pointer hover:opacity-50 ">
            <div id="chart2" class="h-80"></div>
            <script>
                const chart2 = new Chartisan({
                    el: '#chart2',
                    url: "@chart('age_over_time_chart')?from=2021-03-26",
                    hooks: new ChartisanHooks()
                        .datasets([{type:'line',fill: true},])
                        .colors([
                            '#ff0000',
                            '#00ff00',
                            '#0000ff',
                            '#000000',
                            '#FF00FF',
                            '#00FFFF',
                        ]).tooltip(undefined).title('Amount of quotes made by each age group'),
                });
            </script>
        </div>
    </div>
</div>
