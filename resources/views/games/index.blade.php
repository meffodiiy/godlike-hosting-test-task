@extends('layouts.app')

@section('content')
<div class="relative flex size-full min-h-screen flex-col bg-[#181010] dark group/design-root overflow-x-hidden" style='font-family: "Spline Sans", "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-8 lg:px-40 flex flex-1 justify-center py-3 md:py-5">
            <div class="layout-content-container flex flex-col w-full max-w-[1280px] flex-1">
                <div class="@container">
                    <div class="p-2 @[480px]:p-4 space-y-6">
                        <!-- Header with Create Button -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                            <h1 class="text-white text-2xl sm:text-3xl font-bold">Games Library</h1>
                            <a href="{{ route('games.create') }}" 
                               class="mt-4 sm:mt-0 flex justify-center items-center rounded-lg h-10 px-4 bg-[#f97316] text-white font-medium hover:bg-[#ea580c] transition-colors">
                                Add New Game
                            </a>
                        </div>
                        
                        <!-- Search and Filters -->
                        <div class="bg-[#2a2020] rounded-lg border border-[#563939] p-4">
                            <form action="{{ route('games.index') }}" method="GET" class="space-y-4">
                                <div class="w-full">
                                    <label for="search" class="block text-[#bc9a9a] text-sm font-medium mb-1">Search</label>
                                    <input type="text" 
                                           name="search" 
                                           id="search"
                                           value="{{ request('search') }}" 
                                           placeholder="Search by title, developer..." 
                                           class="w-full bg-[#181010] border border-[#563939] rounded-lg p-3 text-white focus:ring-[#f97316] focus:border-[#f97316]">
                                </div>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="genre" class="block text-[#bc9a9a] text-sm font-medium mb-1">Genre</label>
                                        <div class="relative">
                                            <select name="genre" id="genre" class="w-full bg-[#181010] border border-[#563939] rounded-lg p-3 text-white focus:ring-[#f97316] focus:border-[#f97316] appearance-none pr-10">
                                                <option value="">All Genres</option>
                                                @foreach($genres ?? [] as $genre)
                                                    <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                                                        {{ $genre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-white">
                                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="platform" class="block text-[#bc9a9a] text-sm font-medium mb-1">Platform</label>
                                        <div class="relative">
                                            <select name="platform" id="platform" class="w-full bg-[#181010] border border-[#563939] rounded-lg p-3 text-white focus:ring-[#f97316] focus:border-[#f97316] appearance-none pr-10">
                                                <option value="">All Platforms</option>
                                                @foreach($platforms ?? [] as $platform)
                                                    <option value="{{ $platform }}" {{ request('platform') == $platform ? 'selected' : '' }}>
                                                        {{ $platform }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-white">
                                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-2">
                                    <a href="{{ route('games.index') }}" class="w-full sm:w-auto flex justify-center items-center rounded-lg py-2 px-4 bg-[#181010] border border-[#563939] text-white">
                                        Reset
                                    </a>
                                    <button type="submit" class="w-full sm:w-auto flex justify-center items-center rounded-lg py-2 px-4 bg-[#f97316] text-white hover:bg-[#ea580c] transition-colors">
                                        Apply Filters
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Games Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                            @forelse($games as $game)
                                <a href="{{ route('games.show', $game) }}" class="block group">
                                    <div class="bg-[#2a2020] rounded-lg overflow-hidden border border-[#563939] group-hover:border-[#f97316] transition-all duration-200 h-full">
                                        <div class="h-40 bg-cover bg-center" 
                                             @if($game->cover_image)
                                                 style='background-image: url("{{ asset('storage/' . $game->cover_image) }}");'
                                             @else
                                                 style="background-color: #3b3232;"
                                             @endif>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="text-white font-bold truncate">{{ $game->title }}</h3>
                                            <p class="text-[#bc9a9a] text-sm mb-2">{{ $game->developer }}</p>
                                            <div class="flex justify-between items-center">
                                                <span class="text-white font-bold">${{ number_format($game->price, 2) }}</span>
                                                <span class="text-[#f97316] group-hover:text-[#ea580c] text-sm">
                                                    View Details
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="col-span-full text-center py-8">
                                    <p class="text-[#bc9a9a] text-lg">No games available yet.</p>
                                    <a href="{{ route('games.create') }}" class="text-[#f97316] mt-2 inline-block">Add your first game</a>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $games->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
