<div>
    <div class="pb-2">
        @foreach($messages as $message)
            <div class="flex justify-left items-center py-2 space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                <div class="mr-4 bg-gray-500 focus:ring-4 focus:outline-none
                     focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5
                     dark:bg-gray-700 dark:focus:ring-gray-700">
                    @if($message->is_system_message)
                        <div class="flex">
                            <p class="mr-2">
                                <small class="text-xs text-gray-400">{{$message->created_at->toTimeString()}}</small>
                            </p>
                            <p class="break-all font-bold">{{$message->message}}</p>
                        </div>
                    @else
                        <div class="flex">
                            <img class="p-1 w-12 h-12 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                                 src="{{asset('storage/avatars/'.$message->user->avatar)}}"
                                 alt="User Avatar">
                            <div class="flex-col ml-2">
                                <b>{{$message->user->username}}</b>
                                <p class="text-xs text-gray-400 mb-1 w-max">{{$message->created_at->toTimeString()}}</p>
                                <p class="break-all">{{$message->message}}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
