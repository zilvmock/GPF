<div>
    <div class="pb-2">
        @foreach($messages as $message)
            <div class="flex justify-left items-center py-2 space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                <div
                    class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:focus:ring-gray-700">
                    <div class="flex flex-col">
                        <p>
                            <b>{{$message->user->username}}</b>
                            <small class="text-xs text-gray-400">{{$message->created_at->toTimeString()}}</small>
                        </p>
                        <p>{{$message->message}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
