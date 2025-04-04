<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameZ - Game Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #ffffff;
        }
        .navbar {
            background-color: #1a1a1a;
            border-bottom: 1px solid #333;
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
        }
        .table th {
            border-bottom: 1px solid #333;
            color: #ffffff;
        }
        .table td {
            border-bottom: 1px solid #333;
            color: #9a9a9a;
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
        }
        .btn-action:hover {
            background-color: #333;
            color: #ffffff;
        }
        .btn-add {
            background-color: #2a2a2a;
            color: #ffffff;
            border: 1px solid #333;
            padding: 8px 20px;
            border-radius: 20px;
        }
        .btn-add:hover {
            background-color: #333;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('games.index') }}">
                <span class="ms-2 fw-bold">GameZ</span>
            </a>
            <div class="d-flex align-items-center">
                <input type="search" class="form-control search-box me-3" placeholder="Search" style="width: 250px;">
                <button class="btn btn-link text-white me-3">
                    <i class="bi bi-bell"></i>
                </button>
                <button class="btn btn-link text-white me-3">
                    <i class="bi bi-cart"></i>
                </button>
                <img src="https://ui-avatars.com/api/?name=User&background=random" alt="Profile" class="avatar">
            </div>
        </div>
    </nav>

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
                                    <button type="submit" class="btn btn-action btn-sm" onclick="return confirm('Are you sure you want to delete this game?')">Delete</button>
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

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 