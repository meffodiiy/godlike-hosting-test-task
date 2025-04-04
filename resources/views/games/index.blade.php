@extends('layouts.app')

@section('content')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #1a1a1a !important;
        color: #ffffff !important;
    }
    .navbar {
        background-color: #1a1a1a !important;
        border-bottom: 1px solid #333 !important;
    }
    .container {
        max-width: 1320px !important;
        margin: 0 auto !important;
        padding: 0 1rem !important;
    }
    .search-box {
        background-color: #2a2a2a;
        border: none;
        color: #ffffff;
        border-radius: 20px;
    }
    .table {
        background-color: #2a2a2a;
        border-radius: 10px;
        overflow: hidden;
        width: 100%;
        margin-bottom: 1rem;
    }
    .table th {
        border-bottom: 1px solid #333;
        color: #ffffff;
        padding: 1rem;
        background-color: #1a1a1a;
    }
    .table td {
        border-bottom: 1px solid #333;
        color: #9a9a9a;
        padding: 1rem;
        vertical-align: middle;
    }
    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
        width: 100%;
    }
    .table-dark {
        --bs-table-bg: #2a2a2a;
        --bs-table-striped-bg: #252525;
        --bs-table-striped-color: #fff;
        --bs-table-active-bg: #1a1a1a;
        --bs-table-active-color: #fff;
        --bs-table-hover-bg: #333;
        --bs-table-hover-color: #fff;
        color: #fff;
        border-color: #333;
    }
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .main-search {
        background-color: #2a2a2a;
        border-radius: 10px;
        padding: 10px 20px;
        margin-bottom: 30px;
    }
    .btn-action {
        background-color: #2a2a2a;
        color: #ffffff;
        border: 1px solid #333;
        margin: 0 2px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.25rem;
    }
    .btn-action:hover {
        background-color: #333;
        color: #ffffff;
        text-decoration: none;
    }
    .btn-action-danger {
        background-color: #2a1515;
        color: #ff9999;
        border: 1px solid #662222;
        margin: 0 2px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.25rem;
    }
    .btn-action-danger:hover {
        background-color: #661111;
        color: #ffffff;
        text-decoration: none;
    }
    .btn-add {
        background-color: #2a2a2a;
        color: #ffffff;
        border: 1px solid #333;
        padding: 8px 20px;
        border-radius: 20px;
        text-decoration: none;
    }
    .btn-add:hover {
        background-color: #333;
        color: #ffffff;
        text-decoration: none;
    }
    .alert-success {
        background-color: #1a2e1a;
        border-color: #2b582b;
        color: #8eff8e;
    }
    .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    /* Pagination Styling */
    .pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        gap: 0.25rem;
    }
    .pagination .page-item .page-link {
        background-color: #2a2a2a;
        border-color: #333;
        color: #9a9a9a;
        padding: 0.5rem 1rem;
        margin: 0 2px;
        border-radius: 5px;
        text-decoration: none;
    }
    .pagination .page-item.active .page-link {
        background-color: #333;
        border-color: #444;
        color: #ffffff;
    }
    .pagination .page-item.disabled .page-link {
        background-color: #1a1a1a;
        border-color: #333;
        color: #666;
        pointer-events: none;
    }
    .pagination .page-link:hover {
        background-color: #333;
        border-color: #444;
        color: #ffffff;
        text-decoration: none;
    }
    .pagination .page-link:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.1);
    }
    /* Override app layout styles */
    .min-h-screen {
        background-color: #1a1a1a !important;
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
    .text-gray-700 {
        color: #ffffff !important;
    }
</style>

<!-- Main Content -->
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Explore games</h1>
        <a href="{{ route('games.create') }}" class="btn btn-add">Add New Game</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search Bar -->
    <div class="main-search mb-4">
        <input type="search" class="form-control bg-transparent border-0 text-white" placeholder="Search for games">
    </div>

    <!-- Games Table -->
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Developer</th>
                    <th>Genre</th>
                    <th>Release Date</th>
                    <th>Platform</th>
                    <th>Price</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($games as $game)
                    <tr>
                        <td>{{ $game->title }}</td>
                        <td>{{ $game->developer }}</td>
                        <td>{{ $game->genre }}</td>
                        <td>{{ $game->release_date->format('M d, Y') }}</td>
                        <td>{{ $game->platform }}</td>
                        <td>${{ number_format($game->price, 2) }}</td>
                        <td class="text-center">
                            <a href="{{ route('games.show', $game) }}" class="btn btn-action btn-sm">View</a>
                            <a href="{{ route('games.edit', $game) }}" class="btn btn-action btn-sm">Edit</a>
                            <form action="{{ route('games.destroy', $game) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-action-danger btn-sm" onclick="return confirm('Are you sure you want to delete this game?')">Delete</button>
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
        {{ $games->links('vendor.pagination.custom') }}
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
