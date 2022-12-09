<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = str_shuffle(preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName()))
                . '.' . $file->getClientOriginalExtension();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('public/avatars/tmp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);

            return $folder;
        } elseif ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = str_shuffle(preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName()))
                . '.' . $file->getClientOriginalExtension();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('public/chat/tmp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);

            return response()->json([
                'folder' => $folder,
            ]);
        }

        return '';
    }
}
