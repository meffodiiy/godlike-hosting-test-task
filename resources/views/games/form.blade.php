@csrf

<div class="flex flex-col gap-6">
    <!-- Cover Image Upload -->
    <div class="flex flex-col gap-2">
        <label for="cover_image" class="text-[#94a3b8] text-sm font-medium leading-none">Cover Image</label>
        <div class="relative">
            <input type="file" 
                   name="cover_image" 
                   id="cover_image" 
                   accept="image/*"
                   class="form-input w-full min-w-0 resize-none rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-[#3b82f6] focus:ring-opacity-50 border border-[#475569] bg-[#1e293b] transition-all duration-200 h-12 px-4 text-[15px] font-normal leading-relaxed hover:border-[#3b82f6] focus:border-[#3b82f6] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:bg-[#3b82f6] file:text-white hover:file:bg-[#2563eb] file:my-1 @error('cover_image') !border-[#ef4444] !ring-[#ef4444] !ring-opacity-25 @enderror">
        </div>
        @error('cover_image')
            <div class="text-[#ef4444] text-[13px] leading-tight">{{ $message }}</div>
        @enderror
        @if(isset($game) && $game->cover_image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $game->cover_image) }}" alt="Current cover image" class="w-32 h-32 object-cover rounded-lg border border-[#475569]">
            </div>
        @endif
    </div>

    <div class="flex flex-col gap-2">
        <label for="title" class="text-[#94a3b8] text-sm font-medium leading-none">Title<span class="text-[#3b82f6] ml-0.5">*</span></label>
        <div class="relative">
            <input type="text" class="form-input w-full min-w-0 resize-none rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-[#3b82f6] focus:ring-opacity-50 border border-[#475569] bg-[#1e293b] transition-all duration-200 h-12 px-4 text-[15px] font-normal leading-relaxed hover:border-[#3b82f6] focus:border-[#3b82f6] placeholder:text-[#64748b] shadow-sm @error('title') !border-[#ef4444] !ring-[#ef4444] !ring-opacity-25 @enderror" id="title" name="title" value="{{ old('title', isset($game) ? $game->title : '') }}" placeholder="Enter game title" required>
        </div>
        @error('title')
            <div class="text-[#ef4444] text-[13px] leading-tight">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col gap-2">
        <label for="developer" class="text-[#94a3b8] text-sm font-medium leading-none">Developer<span class="text-[#3b82f6] ml-0.5">*</span></label>
        <div class="relative">
            <input type="text" class="form-input w-full min-w-0 resize-none rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-[#3b82f6] focus:ring-opacity-50 border border-[#475569] bg-[#1e293b] transition-all duration-200 h-12 px-4 text-[15px] font-normal leading-relaxed hover:border-[#3b82f6] focus:border-[#3b82f6] placeholder:text-[#64748b] shadow-sm @error('developer') !border-[#ef4444] !ring-[#ef4444] !ring-opacity-25 @enderror" id="developer" name="developer" value="{{ old('developer', isset($game) ? $game->developer : '') }}" placeholder="Enter developer name" required>
        </div>
        @error('developer')
            <div class="text-[#ef4444] text-[13px] leading-tight">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col gap-2">
        <label for="genre" class="text-[#94a3b8] text-sm font-medium leading-none">Genre<span class="text-[#3b82f6] ml-0.5">*</span></label>
        <div class="relative">
            <input type="text" class="form-input w-full min-w-0 resize-none rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-[#3b82f6] focus:ring-opacity-50 border border-[#475569] bg-[#1e293b] transition-all duration-200 h-12 px-4 text-[15px] font-normal leading-relaxed hover:border-[#3b82f6] focus:border-[#3b82f6] placeholder:text-[#64748b] shadow-sm @error('genre') !border-[#ef4444] !ring-[#ef4444] !ring-opacity-25 @enderror" id="genre" name="genre" value="{{ old('genre', isset($game) ? $game->genre : '') }}" placeholder="Enter game genre" required>
        </div>
        @error('genre')
            <div class="text-[#ef4444] text-[13px] leading-tight">{{ $message }}</div>
        @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="flex flex-col gap-2">
            <label for="release_date" class="text-[#94a3b8] text-sm font-medium leading-none">Release Date<span class="text-[#3b82f6] ml-0.5">*</span></label>
            <div class="relative">
                <input type="date" class="form-input w-full min-w-0 resize-none rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-[#3b82f6] focus:ring-opacity-50 border border-[#475569] bg-[#1e293b] transition-all duration-200 h-12 px-4 text-[15px] font-normal leading-relaxed hover:border-[#3b82f6] focus:border-[#3b82f6] placeholder:text-[#64748b] shadow-sm @error('release_date') !border-[#ef4444] !ring-[#ef4444] !ring-opacity-25 @enderror" id="release_date" name="release_date" value="{{ old('release_date', isset($game) ? $game->release_date->format('Y-m-d') : '') }}" required>
            </div>
            @error('release_date')
                <div class="text-[#ef4444] text-[13px] leading-tight">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-2">
            <label for="price" class="text-[#94a3b8] text-sm font-medium leading-none">Price<span class="text-[#3b82f6] ml-0.5">*</span></label>
            <div class="relative">
                <input type="number" step="0.01" class="form-input w-full min-w-0 resize-none rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-[#3b82f6] focus:ring-opacity-50 border border-[#475569] bg-[#1e293b] transition-all duration-200 h-12 px-4 text-[15px] font-normal leading-relaxed hover:border-[#3b82f6] focus:border-[#3b82f6] placeholder:text-[#64748b] shadow-sm @error('price') !border-[#ef4444] !ring-[#ef4444] !ring-opacity-25 @enderror" id="price" name="price" value="{{ old('price', isset($game) ? $game->price : '') }}" placeholder="0.00" required>
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-[#94a3b8]">$</div>
            </div>
            @error('price')
                <div class="text-[#ef4444] text-[13px] leading-tight">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="flex flex-col gap-2">
        <label for="platform" class="text-[#94a3b8] text-sm font-medium leading-none">Platform<span class="text-[#3b82f6] ml-0.5">*</span></label>
        <div class="relative">
            <input type="text" class="form-input w-full min-w-0 resize-none rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-[#3b82f6] focus:ring-opacity-50 border border-[#475569] bg-[#1e293b] transition-all duration-200 h-12 px-4 text-[15px] font-normal leading-relaxed hover:border-[#3b82f6] focus:border-[#3b82f6] placeholder:text-[#64748b] shadow-sm @error('platform') !border-[#ef4444] !ring-[#ef4444] !ring-opacity-25 @enderror" id="platform" name="platform" value="{{ old('platform', isset($game) ? $game->platform : '') }}" placeholder="Enter platform name" required>
        </div>
        @error('platform')
            <div class="text-[#ef4444] text-[13px] leading-tight">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="flex gap-3 mt-8 border-t border-[#475569] pt-6">
    <button type="submit" class="flex min-w-[120px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-12 px-8 bg-[#3b82f6] text-white text-sm font-semibold leading-none tracking-wide hover:bg-[#2563eb] transition-colors duration-200 shadow-sm shadow-[#3b82f6]/25">
        {{ isset($game) ? 'Update' : 'Create' }} Game
    </button>
    <a href="{{ route('games.index') }}" class="flex min-w-[100px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-12 px-8 bg-[#334155] text-[#94a3b8] text-sm font-semibold leading-none tracking-wide hover:bg-[#475569] hover:text-white transition-all duration-200">
        Cancel
    </a>
</div> 