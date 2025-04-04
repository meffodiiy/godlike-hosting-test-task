@extends('layouts.app')

@section('content')
<div class="relative flex size-full min-h-screen flex-col bg-[#181010] dark group/design-root overflow-x-hidden" style='font-family: "Spline Sans", "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-8 lg:px-40 flex flex-1 justify-center py-3 md:py-5">
            <div class="layout-content-container flex flex-col w-full max-w-[960px] flex-1">
                <div class="@container">
                    <div class="p-2 @[480px]:p-4">
                        <h1 class="text-white text-2xl sm:text-3xl font-bold mb-6">Create New Game</h1>
                        
                        @include('games.form', [
                            'formAction' => route('games.store'),
                            'method' => 'POST',
                            'submitButtonText' => 'Create Game'
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 