<x-layout>
    @if(Auth::user())
    <p class="text-neutral-800 md:my-10 sm:my-8 my-5 md:mx-48 sm:mx-20 mx-10 tracking-widest md:text-4xl sm:text-2xl text-2xl uppercase font-sans font-bold">Activities:</p>
        @unless(count($logs) == 0)

        <div class="text-white min-h-min mb-10 bg-neutral-800 md:mx-48 sm:mx-20 mx-10 md:my-10 my-5 px-10 rounded-3xl shadow-new py-8">
            @foreach($logs as $log)
                <div class="font-mono tracking-wide text-xs mb-2">{{$log->description}} - {{$log->created_at}}</div>
            @endforeach
        </div>

        @endunless
    @else
        <p class="text-neutral-800 md:my-10 sm:my-8 my-5 md:mx-10 sm:mx-20 mx-10 tracking-widest md:text-4xl sm:text-2xl text-2xl uppercase font-sans font-bold">WELCOME</p>
    @endif
</x-layout>
