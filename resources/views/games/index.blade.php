@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Games</h3>
                    <a href="{{ route('games.create') }}" class="btn btn-primary">Add New Game</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Developer</th>
                                    <th>Genre</th>
                                    <th>Release Date</th>
                                    <th>Platform</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($games as $game)
                                    <tr>
                                        <td>{{ $game->title }}</td>
                                        <td>{{ $game->developer }}</td>
                                        <td>{{ $game->genre }}</td>
                                        <td>{{ $game->release_date->format('Y-m-d') }}</td>
                                        <td>{{ $game->platform }}</td>
                                        <td>${{ number_format($game->price, 2) }}</td>
                                        <td>
                                            <a href="{{ route('games.show', $game) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('games.edit', $game) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('games.destroy', $game) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this game?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No games found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $games->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 