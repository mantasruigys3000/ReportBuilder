<div class="">

    <div class="bg-white mb-4 py-4 shadow-lg">
        <div class="mx-4 border-solid border-gray-300 border flex flex-row justify-between  ">
            <div class=" w-1/3 text-center  flex flex-col">
                <div class="font-bold text-4xl text-rb-purple">
                    120
                </div>
                <div class="font-bold">
                    Quotes this month
                </div>
                <div class="text-sm">
                    120% more than the last month
                </div>
            </div>

            <div class="w-1/3 text-center   flex flex-col  border-l-2 border-solid border-gray-400 ">
                <div class="font-bold text-4xl text-rb-purple">
                    120
                </div>
                <div class="font-bold">
                    Quotes this month
                </div>
                <div class="text-sm">
                    120% more than the last month
                </div>
            </div>

            <div class="w-1/3 text-center flex flex-col border-l-2 border-solid border-gray-400  ">
                <div class="font-bold text-4xl text-rb-purple ">
                    120
                </div>
                <div class="font-bold">
                    Quotes this month
                </div>
                <div class="text-sm">
                    120% more than the last month
                </div>
            </div>

        </div>
    </div>

    <div class="flex flex-row ">
        <button wire:click="$set('tab','last month')" class=" font-bold px-3  {{$tab == "last month"? 'bg-white' : 'bg-gray-300' }}">Last Month</button>
        <button wire:click="$set('tab','all time')" class="bg-white font-bold px-3  {{$tab == "all time"? 'bg-white' : 'bg-gray-300' }}" >All Time</button>
    </div>

    <div class="shadow-lg" wire:key="{{$tab}}">
        @switch($tab)
            @case("last month")
            <div class="bg-white">
                <div class="flex flex-wrap">
                    <div class="w-full h-80">
                        <h2 class="text-center">Average benefit quote each day for the last month </h2>
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
                        <h2>Number of quotes made this month </h2>
                        <div>
                            <div id="chart1" class="h-80"></div>
                            <script>
                                const chart1 = new Chartisan({
                                    el: '#chart1',
                                    url: "@chart('age_over_time_chart')" + "?from=2021-03-26",
                                    hooks: new ChartisanHooks().datasets([{type:'line',fill: true},])
                                        .colors([
                                            '#ff0000',
                                            '#00ff00',
                                            '#0000ff',
                                            '#000000',
                                            '#FF00FF',
                                            '#00FFFF',
                                        ]).tooltip(undefined).legend(),
                                });
                            </script>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <div class="flex flex-col ">
                            <p>Quotes made by smokers/non smokers last month</p>
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
                                url: "@chart('quote_type_age_count')" + "?from=2021-03-26",
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

                    <div class="w-full">
                        <h2>Number of quotes made </h2>
                        <div>
                            <div id="chart11" class="h-80"></div>
                            <script>
                                const chart11 = new Chartisan({
                                    el: '#chart11',
                                    url: "@chart('age_over_time_chart')",
                                    hooks: new ChartisanHooks().datasets([{type:'line',fill: true},])
                                        .colors([
                                            '#ff0000',
                                            '#00ff00',
                                            '#0000ff',
                                            '#000000',
                                            '#FF00FF',
                                            '#00FFFF',
                                        ]).tooltip(undefined).legend(),
                                });
                            </script>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <div class="flex flex-col ">
                            <p>Quotes made by smokers/non smokers all time</p>
                            <div id="chart22" class="h-80"></div>
                            <script>
                                const chart22 = new Chartisan({
                                    el: '#chart22',
                                    url: "@chart('smoker_chart')"+ "?q={{"all time"}}",
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
                        <div id="chart33" class="h-80"></div>
                        <script>
                            const chart33 = new Chartisan({
                                el: '#chart33',
                                url: "@chart('quote_type_age_count')",
                                hooks: new ChartisanHooks()
                                    .tooltip(true)
                                    .legend()
                            });
                        </script>
                    </div>
                </div>

                </div>
            </div>
            @break
        @endswitch
    </div>
</div>


