@if ($paginator->hasPages())
    <nav aria-label="Pagination Navigation">
        <ul class="flex flex-wrap justify-center items-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true">
                    <span class="flex items-center justify-center px-3 py-2 rounded-md bg-[#2a2020] border border-[#563939] text-[#6b5050] cursor-not-allowed min-w-[40px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex items-center justify-center px-3 py-2 rounded-md bg-[#2a2020] border border-[#563939] text-white hover:bg-[#3a3030] transition-colors min-w-[40px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="hidden sm:block" aria-disabled="true">
                        <span class="flex items-center justify-center px-3 py-2 rounded-md bg-[#2a2020] border border-[#563939] text-[#6b5050] min-w-[40px]">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span class="flex items-center justify-center px-3 py-2 rounded-md bg-[#f97316] border border-[#ea580c] text-white font-medium min-w-[40px]">{{ $page }}</span>
                            </li>
                        @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() - 1)
                            <li>
                                <a href="{{ $url }}" class="flex items-center justify-center px-3 py-2 rounded-md bg-[#2a2020] border border-[#563939] text-white hover:bg-[#3a3030] transition-colors min-w-[40px]">{{ $page }}</a>
                            </li>
                        @elseif ($page === $paginator->lastPage() || $page === 1)
                            <li class="hidden sm:block">
                                <a href="{{ $url }}" class="flex items-center justify-center px-3 py-2 rounded-md bg-[#2a2020] border border-[#563939] text-white hover:bg-[#3a3030] transition-colors min-w-[40px]">{{ $page }}</a>
                            </li>
                        @elseif ($page === $paginator->lastPage() - 1 || $page === 2)
                            <li class="hidden md:block">
                                <a href="{{ $url }}" class="flex items-center justify-center px-3 py-2 rounded-md bg-[#2a2020] border border-[#563939] text-white hover:bg-[#3a3030] transition-colors min-w-[40px]">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex items-center justify-center px-3 py-2 rounded-md bg-[#2a2020] border border-[#563939] text-white hover:bg-[#3a3030] transition-colors min-w-[40px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true">
                    <span class="flex items-center justify-center px-3 py-2 rounded-md bg-[#2a2020] border border-[#563939] text-[#6b5050] cursor-not-allowed min-w-[40px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif 