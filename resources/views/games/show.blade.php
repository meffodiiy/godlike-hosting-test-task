@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>{{ $game->title }}</h3>
                    <div>
                        <a href="{{ route('games.edit', $game) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('games.destroy', $game) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this game?')">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Developer:</strong> {{ $game->developer }}</p>
                            <p><strong>Genre:</strong> {{ $game->genre }}</p>
                            <p><strong>Release Date:</strong> {{ $game->release_date->format('Y-m-d') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Platform:</strong> {{ $game->platform }}</p>
                            <p><strong>Price:</strong> ${{ number_format($game->price, 2) }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('games.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 