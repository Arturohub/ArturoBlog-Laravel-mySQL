<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Post</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .blog-image {
            width: 100%;
            height: auto;
            max-width: 600px; 
            max-height: 500px; 
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    @if(session()->has("success"))
        <div id="success-message" class="bg-green-200 text-green-800 p-4 mb-4">{{ session("success") }}</div>
    @endif

    <div class="container mx-auto lg:px-8 px-2 mt-8 rounded-xl">
        <div class="custom-background flex flex-col items-center justify-center lg:p-14 p-8 mb-4 rounded-xl">
            <p class="font-bold text-2xl mb-8 text-center">{{ $blog->title }}</p>
            <p class="text-xl mb-8 text-center">{{ $blog->subtitle }}</p>
            @foreach ($sentences as $sentence)
                <p class="mb-2 text-justify leading-loose">{{ $sentence }}</p>
            @endforeach
            <img class="mb-8 mt-6 rounded-xl blog-image" src={{$blog->image}} />
            <p class="mb-4">Category: {{ $blog->category }}</p>
            <p class="mb-4">By: {{ $blog->author->name }}</p>
            <p class="mb-2">Created: {{ $blog->created_at->diffForHumans() }}</p>
        </div>

        <div class="container mx-auto lg:px-12 px-4 mt-8 rounded-xl ">
            <h2 class="text-2xl font-semibold mb-4 underline">Comments</h2>
            @forelse($comments as $comment)
                <div class="bg-gray-200 rounded-xl p-2 mb-8 custom-background-2">
                    <p class="font-bold underline">{{ $comment->user->name }} said: </p>
                    <p class="pl-6 pt-6 mb-8 tracking-wider">{{ $comment->comment }}</p>

                  
                    @if(Auth::check() && $comment->user_id === Auth::id())
                        <form class="flex justify-end mb-6" method="post" action="{{ route('comments.delete', ['blog' => $blog->id, 'comment' => $comment->id]) }}" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            @csrf
                            @method("delete")
                            <input type="submit" value="Delete" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded cursor-pointer">
                        </form>
                    @endif
            </div>
            @empty
                <p>No comments yet.</p>
            @endforelse

        </div>
        
        @auth
        <form method="post" action="{{ route('comments.store', ['blog' => $blog->id]) }}" class="mt-8">
            @csrf
            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
            <textarea name="comment" placeholder="Add your comment here" class="w-full border rounded-xl p-2 "></textarea>
            <button type="submit" class="bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 mt-2 rounded mb-8">Post Comment</button>
        </form>
        @else
        <p class="mt-4">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">login</a> to post a comment.</p>
        @endauth
        
    </div>

</body>

<script>
    function toggleReplyForm(event, commentId) {
        event.preventDefault();
        const replyForm = document.getElementById(`replyForm_${commentId}`);
        if (replyForm.style.display === "none") {
            replyForm.style.display = "block";
        } else {
            replyForm.style.display = "none";
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        var successMessage = document.getElementById("success-message");
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = "none";
            }, 5000);
        }
    });
</script>
</html>
