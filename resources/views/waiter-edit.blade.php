<x-layout>
    <p class="text-neutral-800 md:my-10 sm:my-8 my-5 md:mx-10 sm:mx-20 mx-10 tracking-widest md:text-4xl sm:text-2xl text-2xl uppercase font-sans font-bold">{{$orders[0]->order_number}} record</p>
    <div class="text-white min-h-min mb-10 bg-neutral-800 md:mx-10 lg:mx-20 sm:mx-10 mx-5 md:my-10 my-5 px-2 rounded-3xl shadow-new py-8">
        <form action="/waiter/{{$orders[0]->order_number}}/update" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div id="dynamicform">
                <button type="button" id="addRow" class="min-h-min md:ml-3 my-4 font-mono text-xs md:text-normal bg-neutral-500 md:px-3 md:py-2 px-2 py-1 rounded-md shadow-skill hover:bg-opacity-60">Add Row</button>
                <div class="min-h-min text-white w-full flex flex-wrap space-between">
                    <div class="md:font-semibold text-xs leading-wide font-mono w-2/12 justify-center text-center border-solid border-neutral-300 border-r-2 items-center sm:flex ">Order Number</div>
                    <div class="md:font-semibold text-xs leading-wide font-mono w-2/12 justify-center text-center border-solid border-neutral-300 border-r-2 flex items-center">Item</div>
                    <div class="md:font-semibold text-xs leading-wide font-mono w-2/12 justify-center text-center border-solid border-neutral-300 border-r-2 flex items-center">Amount</div>
                    <div class="md:font-semibold text-xs leading-wide font-mono w-2/12 justify-center text-center border-solid border-neutral-300 border-r-2 flex items-center">Total Price</div>
                    <div class="md:font-semibold text-xs leading-wide font-mono w-2/12 justify-center text-center border-solid border-neutral-300 border-r-2 flex items-center">Table Number</div>
                    <div class="md:font-semibold text-xs leading-wide font-mono w-2/12 justify-center text-center overflow-scroll flex items-center">Remove</div>
                </div>
                @unless(count($orders) == 0)

                @foreach($orders as $order)
                <div class="min-h-min text-white w-full flex flex-wrap my-2 justify-center">
                    <div class="item-order min-h-min text-white w-full flex flex-wrap pt-2">
                        <div class="font-semibold sm:px-1 md:px-3 px-0 leading-wide font-mono w-2/12 text-center border-solid border-neutral-300 border-r-2 items-center sm:flex">
                            <input type="text" name="order_number{{$loop->index + 1}}" value="{{$order->order_number}}" class="text-right text-xs sm:text-sm w-full bg-neutral-800" readonly/>
                        </div>
                        <div class="font-semibold leading-wide sm:px-1 md:px-3 px-0 font-mono w-2/12 text-center border-solid border-neutral-300 border-r-2 flex items-center">
                            <select class="text-xs bg-neutral-500 w-full sm:text-sm" id="item-name{{$loop->index + 1}}" name="item{{$loop->index + 1}}" required>
                                <option selected value="{{$order->item}}" class="text-white text-xs">prev: {{$order->item}}</option>
                                @foreach($items as $item)
                                <option value="{{$item->item}}" class="text-white text-sm">{{$item->item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="item_amount font-semibold leading-wide sm:px-1 md:px-3 px-0 font-mono w-2/12 text-center border-solid border-neutral-300 border-r-2 flex items-center">
                            <input type="number" value={{$order->item_amount}} id="item_amount{{$loop->index + 1}}" name="item_amount{{$loop->index + 1}}" class="text-xs px-1 item_amount text-right w-full bg-neutral-500" />
                        </div>
                        <div class="price font-semibold leading-wide sm:px-1 md:px-3 px-0 font-mono w-2/12 text-center border-solid border-neutral-300 border-r-2 flex items-center">
                            <input type="number" id="price" name="price{{$loop->index + 1}}" value={{$order->price}} class="text-xs px-1 price text-right w-full bg-neutral-500"/>
                        </div>
                        <div class="table_number font-semibold leading-wide font-mono sm:px-1 md:px-3 px-0 w-2/12 text-center border-solid border-neutral-300 border-r-2 flex items-center">
                            <input type="number" name="table_number{{$loop->index + 1}}" value="{{$order->table_number}}" class="table_number text-xs px-1 table_number text-center w-full bg-neutral-500"/>
                        </div>
                        <div class="font-semibold leading-wide font-mono w-2/12 text-center">
                            <button type="button" id="removeRow{{$loop->index + 1}}" class="min-h-min font-mono font-normal text-xs bg-neutral-500 sm:px-1 md:px-3 p-1 md:my-1 rounded-md shadow-skill hover:bg-red-500">Remove</button>
                        </div>
                    </div>
                </div>
                @endforeach
                @endunless
            </div>
            @if(Auth::user()->is_cashier == false)
                <button type="submit" name="submit" value="update" id="submit" class="min-h-min md:ml-3 my-4 font-mono text-xs md:text-normal bg-neutral-500 sm:px-1 md:px-3 md:py-2 px-2 py-1 rounded-md shadow-skill hover:bg-opacity-60">Update</button>
            @else
                <button type="submit" name="submit" value="update" id="submit" class="min-h-min md:ml-3 my-4 font-mono text-xs md:text-normal mr-2 bg-neutral-500 sm:px-1 md:px-3 md:py-2 px-2 py-1 rounded-md shadow-skill hover:bg-opacity-60">Update</button>
                <button type="submit" name="submit" value="close" id="close" class="min-h-min md:ml-3 my-4 font-mono text-xs md:text-normal bg-neutral-500 sm:px-1 md:px-3 md:py-2 px-2 py-1 rounded-md shadow-skill hover:bg-opacity-60">Close Transaction</button>
            @endif
        </form>
    </div>
    <div class="hidden" id="employeeid">{{Auth::user()->employeeid}}</div>
    <div class="hidden" id="date">{{date("dmY")}}</div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
            const items = <?php echo json_encode($items); ?>
            // let check = JSON.parse(items)

            const employeeid = document.getElementById("employeeid").innerHTML
            const orders = <?php echo json_encode($orders); ?>

            function zeroPad(num,count)
            {
                var numZeropad = num + '';
                while(numZeropad.length < count) {
                    numZeropad = "0" + numZeropad;
                }
                return numZeropad;
            }

            const date = document.getElementById("date").innerHTML
            const idAndDate = `${employeeid}${date}`
            const numberFormat = !orders[0] ? "001" : zeroPad(parseInt(orders[orders.length-1].order_number.slice(-3)), 3)
            const orderNumber = `${idAndDate}-${numberFormat}`
            var i = zeroPad(parseInt(orders[orders.length-1].order_number.slice(-3)))

            let item = ""
            let price;
            let amount;
            let total;
            let value;

            $('documemt').ready(function () {
                item =  $('select').find(":selected").val();
                price = items.filter(i => i.item === item).map(i => i.price)[0]
                amount = $("input[name*='item_amount']").val()
                value = $("input[name*='table_number']").val()
            })

            $("button[id*='removeRow']").click(function () {
                $(this).parent().parent().remove()
            })

            $("input[name*='price']").on('focus', function() {
                item = $(this).find(":selected").prop('readonly',true);
            });

            $('select').on('change', function() {
                item = $(this).find(":selected").val();
                price = items.filter(i => i.item === item).map(i => i.price)[0]
                amount = $(this).parent().parent().find('div.item_amount').find("input.item_amount").val()
            });

            $("input[name*='item_amount']").on('change', function() {
                amount =  $(this).val()
                total = amount * price
                let gpar = $(this).parent().parent()
                let parent = gpar.find('div.price')
                let changed = parent.find('input.price').val(total).prop('readonly',true)
            });

            $("select[name*='item']").on('change', function() {
                if(!amount){return}
                total = amount * price
                let gpar = $(this).parent().parent()
                let parent = gpar.find('div.price')
                let changed = parent.find('input.price').val(total).prop('readonly',true)
            });

            $("#addRow").click(function () {
                ++i;

                $("#dynamicform").append(
                    `
                    <div class="item-order${i} min-h-min text-white w-full flex flex-wrap pt-2">
                    <div class="font-semibold sm:px-1 md:px-3 px-0 leading-wide font-mono w-2/12 text-center border-solid border-neutral-300 border-r-2 items-center sm:flex">
                        <input type="text" name="order_number${i}" value="${orderNumber}" class="text-right text-xs sm:text-sm w-full bg-neutral-800" readonly/>
                    </div>
                    <div class="font-semibold leading-wide sm:px-1 md:px-3 px-0 font-mono sm:w-2/12 w-3/12 text-center border-solid border-neutral-300 border-r-2 flex items-center">
                        <select class="text-xs bg-neutral-500 w-full sm:text-sm" id="item-name${i}" name="item${i}" required>
                            <option selected class="text-white text-xs">Choose Item</option>
                            @foreach($items as $item)
                            <option value="{{$item->item}}" class="text-white text-sm">{{$item->item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="item_amount font-semibold leading-wide sm:px-1 md:px-3 px-0 font-mono w-2/12 text-center border-solid border-neutral-300 border-r-2 flex items-center">
                        <input type="number" id="item_amount${i}" name="item_amount${i}" class="text-xs px-1 item_amount text-right w-full bg-neutral-500" />
                    </div>
                    <div class="price font-semibold leading-wide sm:px-1 md:px-3 px-0 font-mono sm:w-2/12 w-3/12 text-center border-solid border-neutral-300 border-r-2 flex items-center">
                        <input type="number" id="price" name="price${i}" value="" class="text-xs px-1 price text-right w-full bg-neutral-500"/>
                    </div>
                    <div class="table_number font-semibold leading-wide font-mono sm:px-1 md:px-3 px-0 w-2/12 text-center border-solid border-neutral-300 border-r-2 flex items-center">
                        <input type="number" name="table_number${i}" value="" class="table_number text-xs px-1 table_number text-center w-full bg-neutral-500"/>
                    </div>
                    <div class="font-semibold leading-wide font-mono w-2/12 text-center">
                        <button type="button" id="removeRow${i}" class="min-h-min font-mono font-normal text-xs bg-neutral-500 sm:px-1 md:px-3 p-1 md:my-1 rounded-md shadow-skill hover:bg-red-500">Remove</button>
                    </div>
                    </div>
                    `
                );

                $("input[name*='price']").on('focus', function() {
                    item = $(this).find(":selected").prop('readonly',true);
                });

                $('select').on('change', function() {
                    item = $(this).find(":selected").val();
                    price = items.filter(i => i.item === item).map(i => i.price)[0]
                    amount = $(this).parent().parent().find('div.item_amount').find("input.item_amount").val()
                    console.log(item, price,amount)
                });

                $("input[name*='item_amount']").on('change', function() {
                    amount =  $(this).val()
                    total = amount * price
                    let gpar = $(this).parent().parent()
                    let parent = gpar.find('div.price')
                    let changed = parent.find('input.price').val(total).prop('readonly',true)

                    let parentOrderTaker = gpar.find('div.order-taker')
                    let changedOrderTaker = gpar.find('input.waiter').val(employeeid).prop('readonly',true)
                });

                $("input[name*='table_number']").each(function() {
                    $(this).val(value)
                });

                $("input[name*='table_number']").change(function() {
                    value = $(this).val()

                    $("input[name*='table_number']").each(function() {
                        $(this).val(value)
                    });
                })

                $("select[name*='item']").on('change', function() {
                    if(!amount){return}
                    console.log(amount)
                    total = amount * price
                    let gpar = $(this).parent().parent()
                    let parent = gpar.find('div.price')
                    let changed = parent.find('input.price').val(total).prop('readonly',true)

                    let parentOrderTaker = gpar.find('div.order-taker')
                    let changedOrderTaker = gpar.find('input.waiter').val(employeeid).prop('readonly',true)
                });

                $("button[id*='removeRow']").click(function () {
                    $(this).parent().parent().remove()
                })

            });

    </script>
</x-layout>
