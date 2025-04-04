@extends('layouts.app')

@section('content')
<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        <div class="@container">
            <div class="@[480px]:p-4">
                <div class="flex flex-col gap-6 bg-[#2a2a2a] rounded-xl p-6">
                    <div class="flex flex-col gap-2 text-left border-b border-[#3a2727] pb-4">
                        <h1 class="text-white text-2xl font-bold leading-tight tracking-[-0.015em]">
                            Add a new game
                        </h1>
                    </div>
                    
                    <form action="{{ route('games.store') }}" method="POST" class="flex flex-col gap-4">
                        @include('games.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 