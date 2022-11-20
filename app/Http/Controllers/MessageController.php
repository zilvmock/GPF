<?php

namespace App\Http\Controllers;

use App\Events\SendMessageEvent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->message;
        $room_id = $request->room;
        $user_id = auth()->user()->id;

        $fieldsToVerify = [
            'message' => strip_tags(clean($message)),
        ];

        $validator = Validator::make($fieldsToVerify, [
            'message' => ['required', 'max:2048'],
        ], [
            'required' => 'The :attribute field can not be blank!',
        ]);

        if ($validator->passes()) {
            Message::insert([
                'id' => Str::uuid(),
                'room_id' => $room_id,
                'user_id' => $user_id,
                'message' => $fieldsToVerify['message'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            broadcast(new SendMessageEvent($room_id));
            //return back(); // not needed with AJAX, or rather should return something else
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }
}
