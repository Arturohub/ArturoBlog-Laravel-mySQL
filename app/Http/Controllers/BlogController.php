<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BlogController extends Controller
{
    public function index(){

      
            $blogs = Blog::orderBy('created_at', 'desc')->get();

            
            $categories = Blog::distinct('category')->pluck('category');
    
            
            return view("blogs.index", compact('blogs', 'categories'));
    }

    public function create(){
        return view("blogs.create");
    }

    public function store(Request $request){
        $data = $request->validate([
            "title" => "required",
            "subtitle" => "required",
            "body" => "required",
            "image" => "required|image|mimes:jpeg,jpg,png,gif,svg|max:4096",
            "category" => "required"
        ]);

        $data['user_id'] = Auth::id();
        $imagePath = $request->file('image')->getRealPath();

        $cloudinaryResponse = Cloudinary::upload($imagePath)->getSecurePath();
        $data['image'] = $cloudinaryResponse;

        $newBlog = Blog::create($data);

        return redirect(route("blog.index"))->with("success", "New Blog Post Published Successfully");
    }

    public function edit(Blog $blog){
        return view("blogs.edit", ["blog" => $blog]);
    }

    public function update(Blog $blog, Request $request){
        $data = $request->validate([
            "title" => "required",
            "subtitle" => "required",
            "body" => "required",
            "image" => "required|image|mimes:jpeg,jpg,png,gif,svg|max:4096",
            "category" => "required"
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->getRealPath();
            $cloudinaryResponse = Cloudinary::upload($imagePath)->getSecurePath();
            $data['image'] = $cloudinaryResponse;
        } else {
            unset($data['image']);
        }
    

        $blog->update($data);

        return redirect(route("blog.index"))->with("success", "Blog Updated Successfully");
    }

    public function delete(Blog $blog){
        $blog->delete();
        return redirect(route("blog.index"))->with("success", "Blog Deleted Successfully");
    }

    public function single(Blog $blog)
    {
        $comments = Comment::where('blog_id', $blog->id)->get();
    
        
        $sentences = preg_split('/\.\s*\n/', $blog->body);
    
        return view('blogs.single', ['blog' => $blog, 'comments' => $comments, 'sentences' => $sentences]);
    }
    
    
}
