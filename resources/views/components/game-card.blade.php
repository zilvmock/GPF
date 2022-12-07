@props(['genres'])
<div class="flex-col h-max">
    <a id="game-card-{{$gameId}}" href="{{$route}}"
       style="background-image: url({{$cover}});
       background-size: contain;
       background-repeat: no-repeat;
       aspect-ratio: 9/12;"
       class="block h-max p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md
              dark:bg-gray-800 dark:border-gray-700 flex items-center justify-center">
        <p class="hidden text-center text-white">
            <x-button class="mt-4" type="button" variant="primary" size="sm">
                {{__('Browse Rooms')}}
            </x-button>
        </p>
    </a>
    <div class="flex justify-center">
        <p class="mt-2 text-gray-900 dark:text-purple-400 font-bold">{{__('Rooms')}}: <span
                class="text-lg">{{$room_count}}</span>
        </p>
    </div>
    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">{{$name}}</h5>
    <div class="flex flex-wrap">
        @php($genres = explode(', ', $genres))
        @foreach($genres as $genre)
            <a href="{{route('browse', ['search' => $genre])}}"
               class="bg-gray-100 text-gray-800 font-bold text-sm font-medium mr-2 mt-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                {!! $genre !!}
            </a>
        @endforeach
    </div>
</div>
<script type="module">
    document.getElementById('game-card-{{$gameId}}').addEventListener('mouseenter', function () {
        this.children[0].classList.remove('hidden');
        this.style.backgroundBlendMode = 'multiply';
        this.style.backgroundColor = 'rgb(85,85,85)';
        this.style.filter = 'brightness(0.8)';
    });
    document.getElementById('game-card-{{$gameId}}').addEventListener('mouseleave', function () {
        this.children[0].classList.add('hidden');
        this.style.backgroundBlendMode = 'normal';
        this.style.backgroundColor = 'transparent';
        this.style.filter = '';
    });
</script>
