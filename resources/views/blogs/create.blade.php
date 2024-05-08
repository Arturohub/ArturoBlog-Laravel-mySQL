<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a New Blog Post</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

    @include('layouts.navigation')
    
    <div class="p-6">
        @auth
            @if(auth()->user()->email !== 'arturochicavilla@hotmail.com')
                <div class="h-screen flex flex-col items-center justify-center">
                    <div class="text-center">
                        <p class="text-xl">You are very tricky, but sorry, there is nothing here</p>
                        <p><a href="{{ route('blog.index') }}" class="bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded mt-4">Go back to blogs</a></p>
                    </div>
                </div>
            @endif

            @if(auth()->user()->email === 'arturochicavilla@hotmail.com')
                <div class="custom-background container mx-auto lg:px-8 px-6 mt-8 rounded-xl">
                    <h1 class="flex justify-center text-2xl font-bold mb-4 pt-8 space-center">Create a New Blog Post</h1>
                    <form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col justify-center mb-8">
                            <label class="mb-2 font-bold underline text-lg tracking-wide">Title:</label>
                            <input type="text" name="title" placeholder="Title">
                        </div>
                        <div class="flex flex-col justify-center mb-8">
                            <label class="mb-2 font-bold underline text-lg tracking-wide">Subtitle:</label>
                            <input type="text" name="subtitle" placeholder="Subtitle">
                        </div>
                        <div class="flex flex-col justify-center mb-8">
                            <label class="mb-2 font-bold underline text-lg tracking-wide">Category:</label>
                            <select name="category" class="border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
                                <option value="">Select a category</option>
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
                            <textarea class="h-40 w-full resize-none" name="body" placeholder="Your blog post goes here"></textarea>
                        </div>
                        <div class="flex flex-col justify-center mb-8">
                            <label class="mb-2 font-bold underline text-lg tracking-wide">Image:</label>
                            <input type="file" name="image">
                        </div>
                        <div>
                            <button class="mt-4 bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded cursor-pointer mb-8">Publish a New Blog Post</button>
                        </div>
                    </form>
                </div>
            @endif
        @endauth
    </div>
</body>
</html>
