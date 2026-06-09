<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:'.min(5120, UploadedFile::getMaxFilesize() / 1024),
        ]);

        $path = $request->file('file')->store('posts/inline', 'public');

        return response()->json([
            'url' => Storage::disk('public')->url($path),
        ]);
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:mp4,mov,avi,webm|max:'.min(102400, UploadedFile::getMaxFilesize() / 1024),
        ]);

        $path = $request->file('file')->store('posts/videos/inline', 's3');

        return response()->json([
            'url' => Storage::disk('s3')->url($path),
        ]);
    }
}
