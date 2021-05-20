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
                <div class="flex flex-row py-2">
                    <div class="flex flex-col w-1/3 overflow-scroll border-solid border-gray-300 border-r-2  ">
                        @foreach($clients as $key => $client)
                            <button class="flex flex-row" wire:click="setCurrentClient({{$client->id}})">
                                <div class="pr-2">
                                    Client #{{$client->id}}
                                </div>
                                <div class="pr-2">
                                    {{$client->title}}
                                </div>

                            </button>
                        @endforeach
                    </div>

                    <div class="w-full">
                        @if(isset($currentClient))
                        <div class="w-full" wire:key="{{ $currentClient->getKey()}}">
                            <div class="flex flex-col">
                                <p>Client Number: {{$currentClient->id}}</p>
                                <p>Title: {{$currentClient->title}}</p>
                                <p>Sex: {{$currentClient->sex}}</p>
                                <p>Smoker: {{$currentClient->smoker === true ? 'Yes' : 'No'}}</p>
                            </div>

                            <div class="mt-4">
                               <p>Quotes:</p>
                                @foreach($currentClient->quotes as $quote)
                                    <div class="flex flex-row w-full justify-between">
                                        <div class="flex flex-col shadow-sm ">
                                            <div>
                                                Quoted for a benefit of £{{$quote->benefit}}
                                            </div>
                                            <div>
                                                {{$quote->created_at->format('d-m-Y')}}
                                            </div>
                                        </div>

                                        <div class="flex flex-row">
                                            <div>
                                                <div>
                                                   Protection type: {{$quote->protection_subtype}}
                                                </div>
                                                <div>
                                                   Benefit type: {{$quote->benefit_type}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            {{$clients->links()}}


            @break
        @endswitch
    </div>
</div>
