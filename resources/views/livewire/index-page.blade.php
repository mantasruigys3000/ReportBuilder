<div class="">
    <div class="flex flex-row justify-center ">
        <button wire:click="$set('tab','quotes')" class="text-xl rounded-t-md font-bold px-3 font-bold px-3  {{$tab  == "quotes"? 'bg-white' : 'bg-gray-300' }}">Quotes</button>
        <button wire:click="$set('tab','clients')" class="text-xl rounded-t-md font-bold px-3 bg-white font-bold px-3  {{$tab  == "clients"? 'bg-white' : 'bg-gray-300' }}" >Clients</button>
    </div>

    <div class="bg-white shadow-md">
        @switch($tab)
            @case('quotes')
                quotes
            @break
            @case('clients')
                <div>
                    <h1 class="text-center">Clients</h1>
                    <div class="flex flex-row justify-center">
                        <div class="font-bold">
                            <select wire:model="smoker" name="smoker" id="smoker">
                                <option value="all">All</option>
                                <option value="smokers">Smokers</option>
                                <option value="non-smokers">Non-smokers</option>
                            </select>
                        </div>
                        
                        <div>
                            <select wire:model="orderby" name="orderby" id="">
                                <option value="latest">Created: New - Old</option>
                                <option value="oldest">Created: Old - New</option>
                                <option value="youngold">Age: Youngest - Oldest</option>
                                <option value="oldyoung">Age: Oldest - Youngest</option>
                            </select>
                        </div>


                    </div>
                    <div class="flex flex-row py-2">
                        <div class="flex flex-col w-1/3 overflow-scroll border-solid border-gray-300 border-r-2  ">
                            @foreach($clients as $key => $client)
                                <button class="flex flex-row justify-center text-center font-bold shadow-md {{(isset($currentClient) && $currentClient->id == $client->id)? 'bg-rb-blue': ''}}" wire:click="setCurrentClient({{$client->id}})">
                                    <div class="pr-2">
                                        Client #{{$client->id}}
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
                                                        Quoted for a benefit of ??{{$quote->benefit}}
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
                </div>

            {{$clients->links()}}


            @break
        @endswitch
    </div>
</div>
