<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit a New Blog Post</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
    @include('layouts.navigation')

    <div class="p-6">
        <div class="bg-gray-100 mt-2">
            @if(session()->has("success"))
            <div id="success-message" class="bg-green-200 text-green-800 p-4 mb-4">{{ session("success") }}</div>
            @endif
        </div>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="bg-red-600 text-center text-white font-bold rounded-xl mb-4">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        @if(auth()->id() !== $blog->user_id)
            <div class="h-screen flex flex-col items-center justify-center">
                <div class="text-center">
                    <p class="text-xl">You are very tricky, but sorry, there is nothing here</p>
                    <p><a href="{{ route('blog.index') }}" class="bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded mt-4">Go back to blogs</a></p>
                </div>
            </div>
        @endif

        @if(auth()->id() === $blog->user_id)
        <div class="container m-auto custom-background-2 p-8 rounded-xl ">
            <h1 class="flex justify-center text-2xl font-bold mb-8 space-center">Create a New Blog Post</h1>
            <form method="post" action="{{ route('blog.update', ['blog' => $blog]) }}" enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="flex flex-col justify-center mb-8">
                    <label class="mb-2 font-bold underline text-lg tracking-wide">Title:</label>
                    <input type="text" name="title" placeholder="Title" value="{{ $blog->title }}" />
                </div>
                <div class="flex flex-col justify-center mb-8">
                    <label class="mb-2 font-bold underline text-lg tracking-wide">Subtitle:</label>
                    <input type="text" name="subtitle" placeholder="Subtitle" value="{{ $blog->subtitle }}" />
                </div>
                <div class="flex flex-col justify-center mb-8">
                    <label class="mb-2 font-bold underline text-lg tracking-wide">Subtitle:</label>
                    <select name="category" class="border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
                        <option value="{{ $blog->category }}">{{ $blog->category }}</option>
                        <option value="Art">Art</option>
                        <option value="Basketball">Basketball</option>
                        <option value="Books">Books</option>
                        <option value="Cycling">Cycling</option>
                        <option value="Life">Life</option>
                        <option value="Martial Arts">Martial Arts</option>
                        <option value="Movies">Movies</option>        
                        <option value="Music">Music</option>
                        <option value="Programming">Programming</option>
                        <option value="Travel">Travel</option>
                    </select>
                </div>
                <div class="flex flex-col justify-center mb-8">
                    <label class="mb-2 font-bold underline text-lg tracking-wide">Body:</label>
                    <textarea class="h-40 w-full resize-none" name="body" placeholder="Body">{{ $blog->body }}</textarea>
                </div>
                <div class="flex flex-col justify-center mb-8">
                    <label class="mb-2 font-bold underline text-lg tracking-wide">Image:</label>
                    <input type="file" name="image"  />
                </div>
                <div>
                    <input type="submit" value="Update Blog Post" class="mt-4 bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded cursor-pointer"/>
                </div>
            </form>
        </div>
        @else
            <p>You are not authorized to edit this blog post.</p>
        @endif
       
    </div>

</body>
</html>
