<x-layout>
    @if(Auth::user())
        @unless(count($orders) == 0)

        @foreach($orders as $key => $value)
        <div class="min-h-[40px] py-10 text-white bg-neutral-800 pb-20 md:px-36 px-10 md:my-10 my-3">
            <div class="w-min-w md:ml-3 font-mono font-semibold text-2xl my-2">{{$key}}</div>
            <div class="mb-10 mt-8 tracking-widest">
                @foreach($value as $item)
                    <div class="w-min-w flex flex-wrap">
                        <div class="w-3/12 ml-3 mb-2">{{$item->item}}</div>
                        <div class="w-3/12 ml-3 mb-2 text-center">{{$item->item_amount}}</div>
                        <div class="w-3/12 ml-3 mb-2">{{$item->price}}</div>
                    </div>
                    @endforeach
            </div>
            <a href="/records/{{$key}}" class="text-white min-h-min mt-8 ml-3 font-mono text-normal bg-neutral-500 px-3 py-2 rounded-md shadow-skill hover:bg-blue-600">Show Detail</a>
        </div>
        @endforeach

        @endunless
    @else
        <p class="text-neutral-800 md:my-10 sm:my-8 my-5 md:mx-10 sm:mx-20 mx-10 tracking-widest md:text-4xl sm:text-2xl text-2xl uppercase font-sans font-bold">WELCOME</p>
    @endif
</x-layout>
