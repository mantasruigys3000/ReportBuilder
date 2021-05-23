<div class="bg-white shadow-md flex flex-row py-4">
    <div class="w-1/5 flex flex-col px-4">
        <label class="font-bold" for="from">Start date  </label>
        <input id="fromDate"  id="from" placeholder="from(dd/mm/yyyy)" type="date">
        {{$to}}

        <label class="font-bold" for="to">End date </label>
        <input id="toDate"   id="to" placeholder="to(dd/mm/yyyy)" type="date">

        <button class="bg-green-500 px-4 py-2 font-bold rounded-md text-white mt-2" onclick="update('{{$from}}' , '{{$to}}')">Get chart</button>
        <div id="errordiv" class="text-red-600"></div>

        <div>{{$from}}</div>
    </div>
    <div class="w-full border-l-2 border-solid border-gray-300 ">
            <div id="chart3" class="h-80"></div>
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

                if(new Date(fromdate) >= new Date(todate)){
                    console.log('bad dates');
                    document.getElementById('errordiv').innerText = "Error: start date larger than end date";
                    return;
                }else{
                    document.getElementById('errordiv').innerText = "";

                }

                console.log( fromdate );
                chart3.update({
                    url: "@chart('quote_type_age_count')?from=" + fromdate + '&to='+todate,
                });
            }



        </script>
    </div>

</div>
