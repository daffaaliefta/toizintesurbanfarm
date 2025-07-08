<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\video;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $video = Video::all();
        return view('video.index', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('video.tambah', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:png|max:2048',
        ]);

        // Handle photo upload
        $photoPath = $request->file('photo')->store('uploads/videos', 'public');

        $video = Video::create([
            'customer_id' => $request->customer_id,
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('video.index')->with('success', 'Video berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video not found'], 404);
        }

        return response()->json($video);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $video = video::findOrFail($id);
        return view('video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $video = Video::findOrFail($id); // Gunakan findOrFail untuk menghindari pengulangan kode error handling

        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($video->photo) {
                Storage::disk('public')->delete($video->photo);
            }

            // Simpan foto baru
            $photoPath = $request->file('photo')->store('uploads/videos', 'public');
            $video->photo = $photoPath;
        }

        // Update data video
        $video->update($request->only(['title', 'description']));

        // Redirect ke halaman index dengan flash message
        return redirect()->route('video.index')->with('success', 'Video updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video not found'], 404);
        }

        // Delete the photo
        if ($video->photo) {
            Storage::disk('public')->delete($video->photo);
        }

        $video->delete();

        return redirect()->route('video.index')->with('success', 'Video berhasil ditambahkan!');
    }
}
