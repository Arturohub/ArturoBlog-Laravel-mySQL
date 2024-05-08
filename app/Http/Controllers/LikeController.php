<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        // Validate the request data
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
        ]);

        // Check if the user has already liked the comment
        $existingLike = Like::where('user_id', Auth::id())
                            ->where('comment_id', $request->comment_id)
                            ->exists();

        if ($existingLike) {
            // User has already liked the comment
            return response()->json(['message' => 'You have already liked this comment.'], 422);
        }

        // Create a new like record
        Like::create([
            'user_id' => Auth::id(),
            'comment_id' => $request->comment_id,
        ]);

        return response()->json(['message' => 'Comment liked successfully.']);
    }

    public function unlike(Request $request)
    {
        // Validate the request data
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
        ]);


        $like = Like::where('user_id', Auth::id())
                    ->where('comment_id', $request->comment_id)
                    ->first();

        if (!$like) {
            
            return response()->json(['message' => 'You have not liked this comment.'], 422);
        }


        $like->delete();

        return response()->json(['message' => 'Comment unliked successfully.']);
    }
}
