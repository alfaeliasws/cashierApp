<x-layout>
    <p class="text-neutral-800 md:my-10 sm:my-8 my-5 md:mx-36 sm:mx-20 mx-10 tracking-wide md:text-4xl sm:text-2xl text-2xl uppercase font-sans font-bold">{{$orders[0]->order_number}} record</p>
    <div class="text-white min-h-min mb-10 bg-neutral-800 md:mx-10 lg:mx-20 sm:mx-20 mx-5 md:my-10 my-5 sm:px-10 px-2 rounded-3xl shadow-new py-8">
        <div>
            {{ csrf_field() }}
            <div id="dynamicform">
                <div class="w-10/12 sm:mx-20 mx-10 mb-10">
                    @if(Auth::user()->is_cashier == true || Auth::user()->employeeid === $orders[0]->waiter )
                    <a href="/waiter/{{$orders[0]->order_number}}/edit" id="edit" class="min-h-min sm:mx-auto mb-10 font-mono text-normal bg-neutral-500 sm:px-3 px-3 py-2 rounded-md shadow-skill hover:bg-opacity-60">Edit</a>
                    @endif
                </div>
                <div class="min-h-min text-white w-full flex flex-wrap justify-center">
                    <div class="font-semibold text-xs leading-wide font-mono align-middle w-2/12 text-center border-solid border-neutral-300 border-r-2">Order Number</div>
                    <div class="font-semibold text-xs leading-wide font-mono w-2/12 text-center border-solid border-neutral-300 border-r-2">Item</div>
                    <div class="font-semibold text-xs leading-wide font-mono w-2/12 text-center border-solid border-neutral-300 border-r-2">Amount</div>
                    <div class="font-semibold text-xs leading-wide font-mono w-2/12 text-center border-solid border-neutral-300 border-r-2">Total Price</div>
                    <div class="font-semibold text-xs leading-wide font-mono w-2/12 text-center overflow-scroll">Table Number</div>
                    @if(Auth::user()->is_cashier === 1)
                    <div class="font-semibold text-xs leading-wide font-mono w-2/12 text-center border-solid border-neutral-300 border-l-2">Status</div>
                    @endif
                </div>
                @unless(count($orders) == 0)

                @foreach($orders as $order)
                <div class="min-h-min text-white w-full flex flex-wrap my-2 justify-center">
                    <div class="sm:font-normal text-xs leading-wide font-mono sm:text-sm w-2/12 text-center border-solid border-neutral-300 border-r-2 overflow-scroll">{{$order->order_number}}</div>
                    <div class="sm:font-normal text-xs leading-wide font-mono sm:text-sm w-2/12 text-center border-solid border-neutral-300 border-r-2 overflow-scroll">{{$order->item}}</div>
                    <div class="sm:font-normal text-xs leading-wide font-mono sm:text-sm w-2/12 text-center border-solid border-neutral-300 border-r-2 overflow-scroll">{{$order->item_amount}}</div>
                    <div class="sm:font-normal text-xs leading-wide font-mono sm:text-sm w-2/12 text-center border-solid border-neutral-300 border-r-2 overflow-scroll">{{$order->price}}</div>
                    <div class="sm:font-normal text-xs leading-wide font-mono sm:text-sm w-2/12 text-center">{{$order->table_number}}</div>
                    @if(Auth::user()->is_cashier === 1)
                    <div class="sm:font-normal text-xs leading-wide font-mono sm:text-sm w-2/12 text-center border-solid border-neutral-300 border-l-2">{{$order->status}}</div>
                    @endif
                </div>
                @endforeach

                @endunless
            </div>
        </div>
    </div>
</x-layout>
