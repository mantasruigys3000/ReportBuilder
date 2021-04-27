<div>
    <div class="flex flex-row justify-between items-center pr-2">
        <div >
            <img src="{{asset('images/logo.png')}}" alt="">
        </div>

        <div>
            Hello {{auth()->user()->name}}
        </div>
    </div>

    <div class=" w-48 bg-rb-purple min-h-full fixed flex flex-col  items-center ">
        <div class="flex flex-col text-bold text-2xl py-4">
            <div class="text-rb-blue text-center font-bold ">
                <i class="fas fa-chart-bar"></i>
                <a   href="{{route('dashboard')}}">Dashboard</a>
            </div>

        </div>
    </div>

</div>


