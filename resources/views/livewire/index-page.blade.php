<div class="">
    <div class="flex flex-row ">
        <button wire:click="$set('tab','quotes')" class=" font-bold px-3  {{$tab  == "quotes"? 'bg-white' : 'bg-gray-300' }}">Quotes</button>
        <button wire:click="$set('tab','clients')" class="bg-white font-bold px-3  {{$tab  == "clients"? 'bg-white' : 'bg-gray-300' }}" >Clients</button>
    </div>

    <div class="bg-white shadow-md">
        @switch($tab)
            @case('quotes')
                quotes
            @break
            @case('clients')
                clients
                <div class="flex flex-row h-screen">
                    <div class="flex flex-col w-1/3 overflow-scroll ">
                        @foreach($clients as $key => $client)
                            <button>
                                {{$client->title}}
                            </button>
                        @endforeach

                        {{$clients->links()}}
                    </div>
                    <div>
                        Stuff info stuff
                    </div>
                </div>

            @break
        @endswitch
    </div>
</div>
