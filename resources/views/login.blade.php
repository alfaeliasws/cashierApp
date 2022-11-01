<x-layout>
    <div>
        <p class="text-neutral-800 md:my-10 sm:my-8 my-5 md:mx-48 sm:mx-20 mx-10 tracking-widest md:text-4xl sm:text-2xl text-2xl uppercase font-sans font-bold">Login:</p>
        <div class="text-white min-h-min mb-10 bg-neutral-800 md:mx-48 sm:mx-20 mx-10 md:my-10 my-5 px-10 rounded-3xl shadow-new py-8">

            <form action="/authenticate" method="POST" enctype="multipart/form-data" class="min-h-[100px]">
                {{ csrf_field() }}

                <div class="flex flex-wrap">

                    <div class="font-bold sm:text-2xl text-lg font-sans tracking-kinda pt-3">
                    <label for="employeeid" class="w-full">employeeID:</label>
                    </div>
                    <input type="text" name="employeeid" class="sm:pl-4 pl-2 tracking-widest h-10 w-full my-4 shadow-new rounded-xl bg-neutral-700 placeholder:text-neutral-400 placeholder:opacity-70 placeholder:text-sm"
                    placeholder="Your unique employeeId" value="{{old('employeeId')}}"/>
                    @error('employeeid')
                    <p class="text-red-500 text-xs mt-1 w-full">{{$message}}</p>
                    @enderror

                    <div class="font-bold sm:text-2xl text-lg font-sans tracking-kinda pt-3">
                        <label for="lastname" class="w-full">Password:</label>
                    </div>
                    <input type="password" name="password" class="sm:pl-4 pl-2 tracking-widest h-10 w-full my-4 shadow-new rounded-xl bg-neutral-700 placeholder:text-neutral-400 placeholder:opacity-70 placeholder:text-sm"
                    placeholder="Type your password" value="{{old('password')}}"/>
                    @error('lastname')
                    <p class="text-red-500 text-xs mt-1 w-full">{{$message}}</p>
                    @enderror

                    <button class="shadow-new my-3 bg-neutral-700 text-gray-200 py-2 px-2 rounded-lg hover:bg-neutral-500 hover:px-4 transition-all mb-5 font-mono font-semibold text-lg ">
                        Sign In
                    </button>

                </div>

            </form>
        </div>
    </div>
</x-layout>
