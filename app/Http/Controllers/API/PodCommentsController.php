<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

use Illuminate\Support\Facades\Validator;

class PodCommentsController extends Controller
{
    // --------------------------------
    // Comment Web --------------------------------

    // --------------------------------
    // Create Comment --------------------------------
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'podcast_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $comment = Comment::create([
            'content' => $request->content,
            'podcast_id' => $request->podcast_id,
            'podcaster_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Comment created.');
    }

    // --------------------------------
    // Update Comment --------------------------------
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => 'Validation Error.', 'errors' => $validator->errors()]);
        }
    
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['status' => 0, 'message' => 'Comment not found.']);
        }
    
        if ($comment->podcaster_id != Auth::id()) {
            return response()->json(['status' => 0, 'message' => 'Unauthorized action.']);
        }
    
        $comment->content = $request->content;
        $comment->save();
    
        return response()->json(['status' => 1, 'message' => 'Comment updated.']);
    }

    // --------------------------------
    // Delete Comment --------------------------------
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        if ($comment->podcaster_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted.');
    }

    // --------------------------------
    // Comment APIs --------------------------------

    // --------------------------------
    // Show All Comments --------------------------------
    // public function index (Request $request)
    // {
    //     $comments = Comment::paginate(5);

    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'All comments fetched.',
    //         'data' => $comments
    //     ]);
    // }

    // --------------------------------
    // Create Comment --------------------------------
    // public function store (Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'content' => 'required',
    //         'podcast_id' => 'required',
    //         'podcaster_id' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 0,
    //             'message' => 'Validation Error.',
    //             'data' => $validator->errors()->all()
    //         ]);
    //     }

    //     $comment = Comment::create([
    //         'content' => $request->content,
    //         'podcast_id' => $request->podcast_id,
    //         'podcaster_id' => $request->podcaster_id
    //     ]);

    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'Comment created.',
    //         'data' => $comment
    //     ]);
    // }

    // --------------------------------
    // Find Comment --------------------------------
    // public function show (Request $request, $id)
    // {
    //     $comment = Comment::find($id);

    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'Comment return.',
    //         'data' => $comment
    //     ]);
    // }

    // --------------------------------
    // Update Comment --------------------------------
    // public function update (Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'content' => 'required',
    //         'podcast_id' => 'required',
    //         'podcaster_id' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 0,
    //             'message' => 'Validation Error.',
    //             'data' => $validator->errors()->all()
    //         ]);
    //     }

    //     $comment = Comment::find($id);
    //     $comment->content = $request->content;
    //     $comment->podcast_id = $request->podcast_id;
    //     $comment->podcaster_id = $request->podcaster_id;
    //     $comment->save();

    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'Comment updated.',
    //         'data' => $comment
    //     ]);
    // }

    // --------------------------------
    // Delete Comment --------------------------------
    // public function destroy (Request $request, $id)
    // {
    //     $comment = Comment::find($id);
    //     $comment->delete();

    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'Comment deleted.',
    //         'data' => null
    //     ]);
    // }
}
