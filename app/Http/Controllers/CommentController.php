<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request){
        $data = $request->validate([
            "comment" => "required",
            "blog_id" => "required|exists:blogs,id",
            "parent_comment_id" => "nullable|exists:comments,id",
    ]);


        $data['user_id'] = Auth::id();

        $comment = Comment::create($data);

        return redirect(route("blog.single", ['blog' => $data['blog_id']]))->with("success", "Comment Published Successfully");
    }

    public function display(Request $request){
        $data = $request->validate([
            "comment" => "required",
            "user_id" => "required|exists:user,id",
            "blog_id" => "required|exists:blogs,id",
            "parent_comment_id" => "nullable|exists:comments,id",
        ]);

        $data['user_id'] = Auth::id();

        $comment = Comment::create($data);

        return redirect(route("blog.single", ['blog' => $data['blog_id']]))->with("success", "Comment Created Successfully");
    }

    public function delete($blog, $comment){
        $commentModel = Comment::find($comment);
        $commentModel->delete();
        
        return redirect(route("blog.single", ['blog' => $blog]))->with("success", "Comment Deleted Successfully");
    }

    public function update($blog, $comment, Request $request){
        $data = $request->validate([
            "comment_text" => "required",
        ]);

        $comment->comment = $data['comment_text'];
        $comment->save();

        return redirect(route("blog.single", ['blog' => $blog]))->with("success", "Comment Updated Successfully");
    }
}

   

