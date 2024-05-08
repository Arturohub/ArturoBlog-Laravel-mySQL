<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.navigation')
    <div class="container mx-auto px-4 py-8">
        @if(session()->has("success"))
            <div id="success-message" class="bg-green-200 text-green-800 p-4 mb-4">{{ session("success") }}</div>
        @endif
        @auth
            @if(auth()->user()->email === ('arturochicavilla@hotmail.com'))
                <div class="mb-4">
                    <button class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">
                        <a href="{{ route('blog.create') }}">Write a New Blog Post Here</a>
                    </button>
                </div>
            @endif
        @endauth

        <div class="mb-4 text-right">
            <label for="categoryFilter" class="font-bold"></label>
            <select id="categoryFilter" class="border border-gray-300 rounded-md py-1 mt-1 focus:outline-none focus:ring focus:border-blue-300">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>




        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
            <div id="filterposts" class="custom-background rounded-lg overflow-hidden shadow-md" post-category="{{ $blog->category }}">
                    <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover object-center">
                    <div class="p-6">
                        <p class="font-bold text-xl mb-2 text-black">{{ $blog->title }}</p>
                        <p class="text-gray-700 mb-4">{{ $blog->subtitle }}</p>
                        <p class="text-gray-800 leading-relaxed mb-4 text-justify">{{ Str::words($blog->body, 30) }}</p>
                        <p class="text-gray-700">Author: {{ $blog->author->name }}</p>
                        <p class="text-gray-700">Created: {{ $blog->created_at->diffForHumans() }}</p>
                        <p class="text-gray-700">Comments: {{ $blog->comments->count() }}</p>
                        <div class="mt-4">
                            <a href="{{ route('blog.single', ['blog' => $blog]) }}" class="inline-block bg-green-800 hover:bg-green-950 text-white font-bold py-2 px-4 rounded">Read More</a>
                            @auth
                                @if(auth()->user()->email == env('ADMIN_EMAIL'))
                                    <a href="{{ route('blog.edit', ['blog' => $blog]) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Edit</a>
                                    <form method="post" action="{{ route('blog.delete', ['blog' => $blog]) }}" onsubmit="return confirm('Are you sure you want to delete this comment?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let successMessage = document.getElementById("success-message");
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = "none";
                }, 5000);
            }
        });

        document.getElementById('categoryFilter').addEventListener('change', function() {
        
        let selectedCategory = this.value;
        let blogCards = document.querySelectorAll('#filterposts');

        blogCards.forEach(function(card) {
            let category = card.getAttribute('post-category');
            if (selectedCategory === '' || category === selectedCategory) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>
