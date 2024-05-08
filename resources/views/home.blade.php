<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .bg-h1 {
            background-image: url('{{ asset("images/ufo.jpg") }}');
            background-size: cover;
            background-position: center;
            color: white;
            text-shadow: 0px 0px 30px rgba(0, 0, 0, 0.2); 
        }
        .picture-div {
            height: 550px;
        }
    </style>
</head>
<body>
        @include('layouts.navigation')

        <div class="flex justify-center items-center h-screen">
        
                <div class="container m-auto p-8 py-16 bg-white shadow-xl rounded-lg custom-background-2">
        
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        
                        <div class="text-center flex flex-col justify-center lg:text-left bg-h1 bg-cover bg-center bg-no-repeat p-8 rounded-xl picture-div">
                            <h1 class="text-4xl text-center font-bold text-white ">Welcome to Arturo's Blog</h1>
                            <p class="mt-4 text-xl text-center text-white">Hope you enjoy checking out my blog!</p>
                            <div class="mt-8 space-x-4 text-center text-xl">
                                <button class="bg-green-600 p-2 rounded-lg hover:bg-green-800 mb-4"><a href="{{ route('blog.index') }}"><i class="fas fa-space-shuttle mr-2"></i>Go to Blog</a></button>
                                <button class="bg-green-600 p-2 rounded-lg hover:bg-green-800 mb-4"><a href="{{ route('login') }}"><i class="fas fa-space-shuttle mr-2"></i>Log in</a></button>
                                <button class="bg-green-600 p-2 rounded-lg hover:bg-green-800 mb-4"><a href="{{ route('register') }}"><i class="fas fa-space-shuttle mr-2 "></i>Register</a></button>
                            </div>
                        </div>
        
                        <div class="flex justify-center picture-div ">
                            <img src="{{ asset('images/index.jpg') }}" class="h-full max-w-full rounded-lg shadow-lg" alt="Main Logo">
                        </div>
                        
                    </div>
        
                </div>
        
        </div>
        
        
</body>
</html>