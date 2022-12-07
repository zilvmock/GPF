<div>
    <div class="pb-2">
        @foreach($messages as $message)
            <div class="flex justify-left items-center py-1 space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                <div class="mr-4 bg-gray-500 focus:ring-4 focus:outline-none
                     focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5
                     dark:bg-gray-700 dark:focus:ring-gray-700">
                    @if($message->is_system_message)
                        <div class="flex italic">
                            <p class="mr-2">
                                <small class="text-xs text-gray-400">{{$message->created_at->toTimeString()}}</small>
                            </p>
                            <p class="break-all font-medium text-gray-400">
                                @php
                                    preg_match_all("/'([^']+)'/", $message->message, $matches);
                                    $matches = array_unique($matches[1]);
                                    foreach ($matches as $match) {
                                        $message->message = str_replace("'".$match."'", __($match), $message->message);
                                    }
                                @endphp
                                 {{ $message->message }}
                            </p>
                        </div>
                    @else
                        <div class="flex-col">
                            <div class="flex items-baseline space-x-1">
                                <b class="text-purple-400 text-lg">{{$message->user->username}}</b>
                                <p class="text-xs text-gray-400 w-max">{{$message->created_at->toTimeString()}}</p>
                            </div>
                            <p class="break-all">{{$message->message}}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
