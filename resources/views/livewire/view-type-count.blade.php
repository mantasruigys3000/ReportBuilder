<div class="bg-white shadow-md">
    <div>
        <label for="from">From date (leave blank for earliest possible) </label>
        <input id="fromDate"  id="from" placeholder="from(dd/mm/yyyy)" type="date">
        {{$to}}

        <label for="to">To date (leave blank for current date) </label>
        <input id="toDate"   id="to" placeholder="to(dd/mm/yyyy)" type="date">

        <button onclick="update('{{$from}}' , '{{$to}}')">Get chart</button>

        <div>{{$from}}</div>
    </div>
    <div
        <div>Amount of quotes made by each age group</div>
        <div>
            <div id="chart3" class="h-80"></div>
        </div>
        <script>

            console.log('running');


            let chart3 = new Chartisan({
                el: '#chart3',
                url: "@chart('quote_type_age_count')",
                hooks: new ChartisanHooks().legend().tooltip()
            });

            function update(){

                var fromdate = document.getElementById('fromDate').value;
                var todate = document.getElementById('toDate').value;

                console.log( fromdate );
                chart3.update({
                    url: "@chart('quote_type_age_count')?from=" + fromdate + '&to='+todate,
                });
            }



        </script>
    </div>

</div>
