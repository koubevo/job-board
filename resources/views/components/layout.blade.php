<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Job Board</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body class="mx-auto mt-10 max-w-2xl text-slate-700 bg-gradient-to-r from-indigo-100 from-10% via-sky-100 via-30% to-emerald-100 to-90%">
        <nav class="flex justify-between mb-8 text-lg font-medium">
            <ul class="flex space-x-2">  
                <li>
                    <a href="{{ route('jobs.index') }}">Home</a>
                </li>    
                <li>
                    <a href="{{ route('my-jobs.index') }}">My offers</a>
                </li>      
            </ul>
            <ul class="flex space-x-2">
                @auth
                <li >
                   <a href="{{ route('my-job-applications.index') }}">
                    {{ auth()->user()->name ?? 'Anonymous'}}: Applications
                   </a>
                </li>
                <span class="mx-2">|</span>
                <li>
                    <form action="{{ route('auth.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Logout</button>
                    </form>
                </li>
                @else
                <li>
                    <a href="{{ route('auth.create') }}">Sign in</a>
                </li>
                @endauth
            </ul>
        </nav>
        @if (session('success'))
            <div class="my-8 rounded-md border-l-4 border-green-900 bg-green-100 p-4 text-green-900 opacity-75" role="alert">
           <p class="font-bold">Success!</p>
           <p>{{ session('success') }}</p>   
            </div>            
        @endif
        @if (session('error'))
            <div class="my-8 rounded-md border-l-4 border-red-900 bg-red-100 p-4 text-red-900 opacity-75" role="alert">
           <p class="font-bold">Error!</p>
           <p>{{ session('error') }}</p>   
            </div>            
        @endif
        {{ $slot }}
    </body>
</html>
