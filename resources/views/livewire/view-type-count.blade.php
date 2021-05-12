<div class="bg-white shadow-md">
    <div>
        <label for="from">From date (leave blank for earliest possible) </label>
        <input wire:model="from" id="from" placeholder="from(dd/mm/yyyy)" type="text">
        {{$to}}

        <label for="to">To date (leave blank for current date) </label>
        <input wire:model="to" id="to" placeholder="to(dd/mm/yyyy)" type="text">

        <button wire:click="addkey()" onclick="update('{{$to}}' , '{{$from}}')">Get chart</button>
    </div>
    <div wire:key = "{{$key}}">
        <div>Amount of quotes made by each age group</div>
        <div id="chart3" class="h-80"></div>
        <script>
            const chart3 = new Chartisan({
                el: '#chart3',
                url: "@chart('quote_type_age_count')",
                hooks: new ChartisanHooks().legend().tooltip()
            });

            function update(to,fromdate){
                to = encodeURIComponent(to);
                fromdate = encodeURIComponent(fromdate);

                chart3.update({url:"@chart('quote_type_age_count')" + "?from="+ fromdate + "&to="+ to});
            }


        </script>
    </div>

</div>
