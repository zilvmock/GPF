<div>
    @foreach($users as $user)
        @if($user->id == $owner_id)
            <h1 data-tooltip-target="tooltip-default" class="flex items-center">
                {{$user->username}}
                <x-heroicon-s-star class="w-5 text-yellow-300"/>
            </h1>
            <x-tooltip>Room Owner</x-tooltip>
        @else
            <h1>{{$user->username}}</h1>
        @endif
    @endforeach
</div>
