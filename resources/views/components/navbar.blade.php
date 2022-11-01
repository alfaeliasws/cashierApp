<div {{$attributes->merge(['class' => "bg-neutral-900 flex w-full space-between py-3"])}} >
    <a href="/"" name="logo" class="w-2/12">
        <div class="hidden md:inline" >
            <img class="check my-5 ml-5 lg:h-20 md:h-10 sm:h-8" src="{{asset("LogoWhite.png")}}"/>
        </div>
    </a>
    <div class="sm:w-5/12 invisible sm:visible"></div>
    <div class="w-10/12 sm:w-5/12 flex xl:space-x-20 lg:space-x-14 space-x-4 justify-end items-center xl:mr-20 lg:mr-10 md:mr-5 sm:mr-10 mr-2 check">
        @auth
            <div class="flex hover:opacity-25"> <a href="/" class="font-regular text-white lg:text-xl sm:text-md text-xs font-sans sm:tracking-quite tracking-wider">All Order</a></div>
            <div class="flex hover:opacity-25"> <a href="/activities" class="font-regular text-white lg:text-xl sm:text-md text-xs font-sans sm:tracking-quite tracking-wider">Activities</a></div>
            @if(Auth::user()->is_cashier == true && Auth::user())
            <div class="flex hover:opacity-25 align-middle pt-4">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="mr-3 font-regular text-white lg:text-xl sm:text-md text-xs font-sans sm:tracking-quite tracking-wider">
                        Logout
                    </button>
                </form>
            </div>
            @elseif(Auth::user()->is_cashier == false && Auth::user())
            <div class="flex hover:opacity-25"> <a href="/waiter" class="font-regular text-white lg:text-xl sm:text-md text-xs font-sans sm:tracking-quite tracking-wider">Take Order</a></div>
            <div class="flex hover:opacity-25 align-middle pt-4">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="mr-3 font-regular text-white lg:text-xl sm:text-md text-xs font-sans sm:tracking-quite tracking-wider">
                        Logout
                    </button>
                </form>
            </div>
            @endif
        @else
        <div class="flex hover:opacity-25"><a href="/login" class="font-regular text-white lg:text-xl sm:text-md text-xs font-sans sm:tracking-quite tracking-wider">Login</a></div>
        @endauth
    </div>
</div>
