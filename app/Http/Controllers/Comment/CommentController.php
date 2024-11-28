<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;

class CommentController extends Controller
{
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
}
