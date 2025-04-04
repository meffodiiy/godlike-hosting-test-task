@extends('layouts.app')

@section('content')
<div class="relative flex size-full min-h-screen flex-col bg-[#181010] dark group/design-root overflow-x-hidden" style='font-family: "Spline Sans", "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-40 flex flex-1 justify-center py-5">
            <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
                <div class="@container">
                    <div class="@[480px]:p-4">
                        <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-xl items-start justify-end px-4 pb-10 @[480px]:px-10"
                             @if($game->cover_image)
                                style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url("{{ asset('storage/' . $game->cover_image) }}");'
                             @endif>
                            <div class="flex flex-col gap-2 text-left">
                                <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em]">
                                    {{ $game->title }}
                                </h1>
                                <p class="text-white text-3xl font-extrabold leading-tight">${{ number_format($game->price, 2) }}</p>
                            </div>
                        </div>
                        
                        <div class="p-4 grid grid-cols-2">
                            <div class="flex flex-col gap-1 border-t border-solid border-t-[#563939] py-4 pr-2">
                                <p class="text-[#bc9a9a] text-sm font-normal leading-normal">Genre</p>
                                <p class="text-white text-sm font-normal leading-normal">{{ $game->genre }}</p>
                            </div>
                            <div class="flex flex-col gap-1 border-t border-solid border-t-[#563939] py-4 pl-2">
                                <p class="text-[#bc9a9a] text-sm font-normal leading-normal">Developer</p>
                                <p class="text-white text-sm font-normal leading-normal">{{ $game->developer }}</p>
                            </div>
                            <div class="flex flex-col gap-1 border-t border-solid border-t-[#563939] py-4 pr-2">
                                <p class="text-[#bc9a9a] text-sm font-normal leading-normal">Release Date</p>
                                <p class="text-white text-sm font-normal leading-normal">{{ $game->release_date->format('F j, Y') }}</p>
                            </div>
                            <div class="flex flex-col gap-1 border-t border-solid border-t-[#563939] py-4 pl-2">
                                <p class="text-[#bc9a9a] text-sm font-normal leading-normal">Platform</p>
                                <p class="text-white text-sm font-normal leading-normal">{{ $game->platform }}</p>
                            </div>
                        </div>
                        
                        <div class="p-4 flex justify-end gap-3 border-t border-solid border-t-[#563939] mt-2">
                            <a href="{{ route('games.edit', $game) }}" 
                               class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-[#2a2020] border border-[#563939] text-white text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em]">
                                <span class="truncate">Edit</span>
                            </a>
                            <form action="{{ route('games.destroy', $game) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this game?')"
                                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-[#ef4444] text-white text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em]">
                                    <span class="truncate">Delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
