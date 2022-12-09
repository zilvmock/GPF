<?php

namespace App\Http\Controllers;

use App\Events\SendMessageEvent;
use App\Models\Message;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->message;
        $room_id = $request->room;
        $user_id = auth()->user()->id;
        $folder = $request->folder;

        if (!$message && !$folder) {
            return response()->json([
                'status' => 'error',
                'message' => 'No message or image found',
            ]);
        }

        $temporaryFile = TemporaryFile::where('folder', $folder ?? '')->first();

        $fields = [
            'message' => strip_tags(clean($message)),
        ];

        if ($temporaryFile) {
            $validator = Validator::make($fields, [
                'message' => ['max:1024'],
            ]);
        } else {
            $validator = Validator::make($fields, [
                'message' => ['required', 'max:1024'],
            ], [
                'message.required' => 'Message is required',
            ]);
        }


        if ($validator->passes()) {
            if ($temporaryFile) {
                rename(
                    storage_path('app/public/chat/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename),
                    storage_path('app/public/chat/' . $temporaryFile->filename)
                );
                $fields['image'] = $temporaryFile->filename;
                rmdir(storage_path('app/public/chat/tmp/' . $folder));
                $temporaryFile->delete();
            }

            Message::insert([
                'room_id' => $room_id,
                'user_id' => $user_id,
                'message' => $fields['message'],
                'image' => $fields['image'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            broadcast(new SendMessageEvent($room_id));
            return response()->json(['success' => 'Message sent!'], 200);
        } else {
            return redirect()->json(['error' => $validator->errors()->all()], 400);
        }
    }
}
