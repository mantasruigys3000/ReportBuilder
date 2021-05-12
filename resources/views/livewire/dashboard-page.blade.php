<div class="">

    <div class="flex flex-row ">
        <button wire:click="$set('tab','last month')" class=" font-bold px-3  {{$tab == "last month"? 'bg-white' : 'bg-gray-300' }}">Last Month</button>
        <button wire:click="$set('tab','all time')" class="bg-white font-bold px-3  {{$tab == "all time"? 'bg-white' : 'bg-gray-300' }}" >All Time</button>
    </div>

    <div wire:key="{{$tab}}">
        @switch($tab)
            @case("last month")
            <div class="bg-white">
                <div class="flex flex-wrap">
                    <div class="w-full h-80">
                        <h2>Average benefit quote each month </h2>
                        <div>
                            <div id="chart" class="h-80"></div>
                            <script>
                                const chart = new Chartisan({
                                    el: '#chart',
                                    url: "@chart('test_chart')" + "?q={{"last month"}}",
                                    hooks: new ChartisanHooks().datasets([{type:'line',fill: true},]).colors(['#ff0000','#00ff00']).tooltip(undefined).legend(),
                                });
                            </script>
                        </div>
                    </div>

                    <div class="w-full">
                        <h2>Average benefit quote each month </h2>
                        <div>
                            <div id="chart1" class="h-80"></div>
                            <script>
                                const chart1 = new Chartisan({
                                    el: '#chart1',
                                    url: "@chart('age_over_time_chart')" + "?q={{"last month"}}",
                                    hooks: new ChartisanHooks().datasets([{type:'line',fill: true},]).colors(['#ff0000','#00ff00']).tooltip(undefined).legend(),
                                });
                            </script>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <div class="flex flex-col ">
                            <p>Quotes made by smokers/non smokers ALL TIME</p>
                            <div id="chart2" class="h-80"></div>
                            <script>
                                const chart2 = new Chartisan({
                                    el: '#chart2',
                                    url: "@chart('smoker_chart')" + "?q={{"last month"}}",
                                    type:'pie',
                                    hooks: new ChartisanHooks()
                                        .datasets('pie')
                                        .tooltip(true)
                                        .colors()
                                        .axis(false)
                                });
                            </script>
                        </div>

                    </div>
                    <div class="w-1/2">
                        <div id="chart3" class="h-80"></div>
                        <script>
                            const chart3 = new Chartisan({
                                el: '#chart3',
                                url: "@chart('quote_type_age_count')" + "?q={{"last month"}}",
                                hooks: new ChartisanHooks()
                                    .tooltip(true)
                                    .legend()
                            });
                        </script>
                    </div>
                </div>
            </div>
            @break
            @case("all time")
            <div class="bg-white">
                <div class="flex flex-wrap">
                    <div class="w-full h-80">
                        <h2>Average benefit quote each month </h2>
                        <div  >
                            <div id="chart" class="h-80"></div>
                            <script>
                                const chart = new Chartisan({
                                    el: '#chart',
                                    url: "@chart('test_chart')" + "?q={{"all time"}}",
                                    hooks: new ChartisanHooks().datasets([{type:'line'}]),
                                });
                            </script>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <div class="flex flex-col ">
                            <p>Quotes made by smokers/non smokers ALL TIME</p>
                            <div id="chart2" class="h-80"></div>
                            <script>
                                const chart2 = new Chartisan({
                                    el: '#chart2',
                                    url: "@chart('smoker_chart')" + "?q={{"all time"}}",
                                    type:'pie',
                                    hooks: new ChartisanHooks()
                                        .datasets('pie')
                                        .tooltip(true)
                                        .colors()
                                        .axis(false)
                                });
                            </script>
                        </div>

                    </div>
                    <div class="w-1/2">chart4</div>
                </div>
            </div>
            @break
        @endswitch
    </div>
</div>


