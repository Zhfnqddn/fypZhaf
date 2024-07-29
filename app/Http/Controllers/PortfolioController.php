<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PortfolioController extends Controller
{
    public function indexPictures()
    {
        $pictures = Picture::where('staff_ID', Auth::id())->get();
        return view('staff.picture', compact('pictures'));
    }

    public function storePicture(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $staffId = Auth::id();
        Log::info('Authenticated Staff ID: ' . $staffId);

        if (!$staffId) {
            return redirect()->route('staff.pictures.index')->with('error', 'User is not authenticated.');
        }

        $file = $request->file('image');

        // Upload the file to Cloudinary
        $uploadedFile = Cloudinary::upload($file->getRealPath(), [
            'folder' => 'pictures',
        ]);

        $uploadedFileUrl = $uploadedFile->getSecurePath(); // Retrieve the secure URL from the result
        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        Picture::create([
            'picture_Name' => $originalFileName,
            'picture_FilePath' => $uploadedFileUrl,
            'staff_ID' => $staffId,
        ]);

        return redirect()->route('staff.pictures.index')->with('success', 'Picture uploaded successfully.');
    }

    public function destroyPicture(Picture $picture)
    {
        if ($picture->staff_ID == Auth::id()) {
            $picture->delete();
            return redirect()->route('staff.pictures.index')->with('success', 'Picture deleted successfully.');
        }

        return redirect()->route('staff.pictures.index')->with('error', 'You are not authorized to delete this picture.');
    }

    public function indexVideos()
    {
        $videos = Video::where('staff_ID', Auth::id())->get();
        return view('staff.video', compact('videos'));
    }

    public function storeVideo(Request $request)
    {
        Log::info('StoreVideo called with request: ', $request->all());

        $request->validate([
            'video' => 'required|mimetypes:video/mp4,video/avi,video/mpeg|max:10240',
        ]);

        $staffId = Auth::id();
        Log::info('Authenticated Staff ID: ' . $staffId);

        if (!$staffId) {
            return redirect()->route('staff.videos.index')->with('error', 'User is not authenticated.');
        }

        $file = $request->file('video');
        Log::info('Video file: ', ['file' => $file]);

        try {
            // Upload the video to Cloudinary
            $uploadedFile = Cloudinary::uploadVideo($file->getRealPath(), [
                'folder' => 'videos',
            ]);

            $uploadedFileUrl = $uploadedFile->getSecurePath(); // Retrieve the secure URL from the result
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            Log::info('Video Path: ' . $uploadedFileUrl);
            Log::info('Original File Name: ' . $originalFileName);

            Video::create([
                'video_Name' => $originalFileName,
                'video_FilePath' => $uploadedFileUrl,
                'staff_ID' => $staffId,
            ]);

            return redirect()->route('staff.videos.index')->with('success', 'Video uploaded successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing video: ' . $e->getMessage());
            return redirect()->route('staff.videos.index')->with('error', 'Failed to upload video.');
        }
    }

    public function destroyVideo(Video $video)
    {
        if ($video->staff_ID == Auth::id()) {
            $video->delete();
            return redirect()->route('staff.videos.index')->with('success', 'Video deleted successfully.');
        }

        return redirect()->route('staff.videos.index')->with('error', 'You are not authorized to delete this video.');
    }
}
