<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Podcast;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Routes;

class PodcastController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $query = Podcast::query();
            $showDeleted = $request->input('show_deleted', false);
    
            // Get current podcaster's id
            $podcasterId = Auth::id();
            
            // Filter by podcaster
            $query->where('podcaster_id', $podcasterId);
            
            if ($showDeleted) {
                $query->onlyTrashed(); // Chỉ hiển thị podcast đã xóa
            }
            // If search term exists
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'LIKE', '%'.$search.'%')
                      ->orWhere('description', 'LIKE', '%'.$search.'%');
                });
            }
    
            // Get paginated results
            $podcasts = $query->orderBy('created_at', 'desc')
                             ->paginate(5)
                             ->withQueryString(); // Preserves query parameters in pagination links
    
            // If AJAX request, return partial view
            // if ($request->ajax()) {
            //     return view('partials.podcast-list', compact('podcasts'))->render();
            // }
    
            // Return full view with results
            return view('crud', compact('podcasts', 'showDeleted'));
    
        } catch (\Exception $e) {
            \Log::error('Search error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while searching podcasts');
        }
    }
public function restore($id)
    {
        try {
            $podcast = Podcast::withTrashed()->findOrFail($id);
            $podcast->restore();
            
            return redirect()->route('podcast.crud')
                ->with('success', 'Podcast restored successfully');
                
        } catch (\Exception $e) {
            \Log::error('Podcast restore error: ' . $e->getMessage());
            return back()->with('error', 'Error restoring podcast');
        }
    }

    public function show($id)
    {
        $podcast = Podcast::findOrFail($id);
        return view('podcast.single-podcast', compact('podcast'));
    }

    public function loadAddPage()
    {
        $categories = Category::all();
        return view('crud-add', compact('categories'));
    }

    public function addPodcast(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'podcaster_id' => 'required|string',
            'audio' => 'required|file|mimes:mp3,wav,ogg|max:51200', // 50MB max
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 2MB max
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $podcasterId = Auth::user()->id;
            // Handle audio file upload
            if ($request->hasFile('audio')) {
                $audioFile = $request->file('audio');
                
                // Verify the audio file is valid
                if (!$audioFile->isValid()) {
                    return back()->with('error', 'Invalid audio file')->withInput();
                }

                $audioFileName = time() . '_' . $audioFile->getClientOriginalName();
                
                // Make sure the directory exists
                $audioPath = $audioFile->storeAs('public/podcasts/audio', $audioFileName);
                
                $request->merge(['podcaster_id' => $podcasterId]);

                if (!$audioPath) {
                    return back()->with('error', 'Failed to save audio file')->withInput();
                }

                $audioUrl = asset('storage/podcasts/audio/' . $audioFileName);
            } else {
                return back()->with('error', 'Audio file is required')->withInput();
            }

            // Handle image file upload
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                
                if (!$imageFile->isValid()) {
                    return back()->with('error', 'Invalid image file')->withInput();
                }

                $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
                $imagePath = $imageFile->storeAs('public/podcasts/images', $imageFileName);
                
                if (!$imagePath) {
                    return back()->with('error', 'Failed to save image file')->withInput();
                }

                $imageUrl = asset('storage/podcasts/images/' . $imageFileName);
            } else {
                return back()->with('error', 'Image file is required')->withInput();
            }

            // Create podcast
            $podcast = Podcast::create([
                'title' => $request->title,
                'description' => $request->description,
                'audio' => $audioFileName,
                'image' => $imageFileName,
                'duration' => $request->duration,
                'category_id' => $request->category_id,
                'podcaster_id' => $request->podcaster_id, // Uncomment if you want to add a podcaster relationship to the podcast.
            ]);

            return redirect()->route('podcast.crud')->with('success', 'Podcast added successfully!');

        } catch (\Exception $e) {
            \Log::error('Podcast upload error: ' . $e->getMessage());
            return back()->with('error', 'Error uploading podcast: ' . $e->getMessage())->withInput();
        }
    }

    public function deletePodcast($id)
    {
        try {
            $podcast = Podcast::findOrFail($id);
            
            // Delete the audio file if it exists
            if ($podcast->audio) {
                $audioPath = str_replace(asset('storage/'), 'public/', $podcast->audio);
                Storage::delete($audioPath);
            }
            
            // Delete the image file if it exists
            if ($podcast->image) {
                $imagePath = str_replace(asset('storage/'), 'public/', $podcast->image);
                Storage::delete($imagePath);
            }
            
            // Delete the podcast record
            $podcast->delete();
            
            return redirect()->route('podcast.crud')->with('success', 'Podcast deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Podcast deletion error: ' . $e->getMessage());
            return back()->with('error', 'Error deleting podcast: ' . $e->getMessage());
        }
    }

    public function loadUpdatePage($id)
    {
        $podcast = Podcast::findOrFail($id);
        $categories = Category::all();
        return view('crud-update', compact('podcast', 'categories'));
    }

    public function updatePodcast(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'podcaster_id' => 'required|string',
            'audio' => 'nullable|file|mimes:mp3,wav,ogg|max:51200', // 50MB max
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB max
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $podcast = Podcast::findOrFail($id);

            // Handle audio file upload if new file provided
            if ($request->hasFile('audio')) {
                $audioFile = $request->file('audio');
                if (!$audioFile->isValid()) {
                    return back()->with('error', 'Invalid audio file')->withInput();
                }

                // Delete old audio file
                if ($podcast->audio) {
                    Storage::delete('public/podcasts/audio/' . $podcast->audio);
                }

                $audioFileName = time() . '_' . $audioFile->getClientOriginalName();
                $audioPath = $audioFile->storeAs('public/podcasts/audio', $audioFileName);
                
                if (!$audioPath) {
                    return back()->with('error', 'Failed to save audio file')->withInput();
                }
                
                $podcast->audio = $audioFileName;
            }

            // Handle image file upload if new file provided
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                if (!$imageFile->isValid()) {
                    return back()->with('error', 'Invalid image file')->withInput();
                }

                // Delete old image file
                if ($podcast->image) {
                    Storage::delete('public/podcasts/images/' . $podcast->image);
                }

                $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
                $imagePath = $imageFile->storeAs('public/podcasts/images', $imageFileName);
                
                if (!$imagePath) {
                    return back()->with('error', 'Failed to save image file')->withInput();
                }
                
                $podcast->image = $imageFileName;
            }

            // Update podcast details
            $podcast->title = $request->title;
            $podcast->description = $request->description;
            $podcast->duration = $request->duration;
            $podcast->category_id = $request->category_id;
            $podcast->podcaster_id = $request->podcaster_id; // Uncomment if you want to add a podcaster relationship to the podcast.
            $podcast->save();

            return redirect()->route('podcast.crud')->with('success', 'Podcast updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Podcast update error: ' . $e->getMessage());
            return back()->with('error', 'Error updating podcast: ' . $e->getMessage())->withInput();
        }
    }
}