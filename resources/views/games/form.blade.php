@csrf

<div class="relative flex min-h-screen flex-col bg-[#181010] dark group/design-root overflow-x-hidden" style='font-family: "Spline Sans", "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-8 lg:px-40 flex flex-1 justify-center py-3 md:py-5">
            <div class="layout-content-container flex flex-col w-full max-w-[960px] flex-1">
                <div class="@container">
                    <div class="p-2 @[480px]:p-4">
                        @if ($errors->any())
                            <div class="bg-red-600 text-white p-4 rounded-lg mb-6">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                
                        <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data" class="w-full px-0 sm:px-6 space-y-4 sm:space-y-6">
                            @csrf
                            @if ($method === 'PUT')
                                @method('PUT')
                            @endif
                            
                            <div class="mb-4">
                                <label for="title" class="block text-[#bc9a9a] text-sm font-medium mb-2">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $game->title ?? '') }}" 
                                    class="w-full bg-[#2a2020] border border-[#563939] rounded-lg p-3 text-white focus:ring-[#f97316] focus:border-[#f97316]" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="developer" class="block text-[#bc9a9a] text-sm font-medium mb-2">Developer</label>
                                <input type="text" name="developer" id="developer" value="{{ old('developer', $game->developer ?? '') }}" 
                                    class="w-full bg-[#2a2020] border border-[#563939] rounded-lg p-3 text-white focus:ring-[#f97316] focus:border-[#f97316]" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="genre" class="block text-[#bc9a9a] text-sm font-medium mb-2">Genre</label>
                                <input type="text" name="genre" id="genre" value="{{ old('genre', $game->genre ?? '') }}" 
                                    class="w-full bg-[#2a2020] border border-[#563939] rounded-lg p-3 text-white focus:ring-[#f97316] focus:border-[#f97316]" required>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="release_date" class="block text-[#bc9a9a] text-sm font-medium mb-2">Release Date</label>
                                    <input type="date" name="release_date" id="release_date" value="{{ old('release_date', isset($game) ? $game->release_date->format('Y-m-d') : '') }}" 
                                        class="w-full bg-[#2a2020] border border-[#563939] rounded-lg p-3 text-white focus:ring-[#f97316] focus:border-[#f97316]" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="platform" class="block text-[#bc9a9a] text-sm font-medium mb-2">Platform</label>
                                    <input type="text" name="platform" id="platform" value="{{ old('platform', $game->platform ?? '') }}" 
                                        class="w-full bg-[#2a2020] border border-[#563939] rounded-lg p-3 text-white focus:ring-[#f97316] focus:border-[#f97316]" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="price" class="block text-[#bc9a9a] text-sm font-medium mb-2">Price</label>
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $game->price ?? '') }}" 
                                    class="w-full bg-[#2a2020] border border-[#563939] rounded-lg p-3 text-white focus:ring-[#f97316] focus:border-[#f97316]" required>
                            </div>
                            
                            <div class="mb-6">
                                <label for="cover_image" class="block text-[#bc9a9a] text-sm font-medium mb-2">Cover Image</label>
                                <input type="file" name="cover_image" id="cover_image" 
                                    class="w-full bg-[#2a2020] border border-[#563939] rounded-lg p-3 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#3b3232] file:text-white file:my-1 hover:file:bg-[#4a4040]">
                                
                                @if(isset($game) && $game->cover_image)
                                    <div class="mt-2">
                                        <p class="text-[#bc9a9a] text-sm">Current image:</p>
                                        <div class="mt-2 relative w-full h-40 overflow-hidden rounded-lg">
                                            <img src="{{ asset('storage/' . $game->cover_image) }}" alt="Cover image" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                @endif
                            </div>
                    
                            <div class="flex flex-col sm:flex-row justify-between gap-3">
                                <a href="{{ route('games.index') }}" 
                                    class="w-full sm:w-auto flex justify-center items-center rounded-lg py-3 px-6 bg-[#2a2020] border border-[#563939] text-white font-medium hover:bg-[#3a3030] transition-colors">
                                    Cancel
                                </a>
                                <button type="submit" 
                                    class="w-full sm:w-auto flex justify-center items-center rounded-lg py-3 px-6 bg-[#f97316] text-white font-medium hover:bg-[#ea580c] transition-colors">
                                    {{ $submitButtonText }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 