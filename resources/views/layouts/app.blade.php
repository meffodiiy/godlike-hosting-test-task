<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #1a1a1a;
            color: #ffffff;
        }
        .bg-white {
            background-color: #1a1a1a !important;
        }
        .border-gray-100 {
            border-color: #333 !important;
        }
        .text-gray-500 {
            color: #9a9a9a !important;
        }
        .text-gray-700, .hover\:text-gray-700:hover {
            color: #ffffff !important;
        }
        .hover\:border-gray-300:hover {
            border-color: #444 !important;
        }
        .font-medium {
            font-weight: 500;
        }
        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem;
        }
        .font-bold {
            font-weight: 700;
        }
        .min-h-screen {
            background-color: #1a1a1a;
        }
        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        nav a.text-xl.font-bold {
            color: #ffffff;
            text-decoration: none;
        }
        nav a.inline-flex {
            color: #9a9a9a;
            text-decoration: none;
            transition: all 0.2s;
        }
        nav a.inline-flex:hover {
            color: #ffffff;
            border-color: #444;
        }
        /* Content spacing */
        .page-content {
            margin-top: 2rem;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('games.index') }}" class="text-xl font-bold">
                                Game Store
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('games.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                Games
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <div class="page-content">
            <main class="container">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html> 