<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Game::query();

        // Search functionality
        if (request('search')) {
            $searchTerm = request('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('developer', 'like', "%{$searchTerm}%")
                  ->orWhere('genre', 'like', "%{$searchTerm}%")
                  ->orWhere('platform', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by genre
        if (request('genre')) {
            $query->where('genre', request('genre'));
        }

        // Filter by platform
        if (request('platform')) {
            $query->where('platform', request('platform'));
        }

        // Get unique genres and platforms for filter dropdowns
        $genres = Game::distinct()->pluck('genre')->sort();
        $platforms = Game::distinct()->pluck('platform')->sort();

        $games = $query->latest()->paginate(10);

        return view('games.index', compact('games', 'genres', 'platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'developer' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'release_date' => 'required|date',
            'platform' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Game::create($validated);

        return redirect()->route('games.index')
            ->with('success', 'Game created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'developer' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'release_date' => 'required|date',
            'platform' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $game->update($validated);

        return redirect()->route('games.index')
            ->with('success', 'Game updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index')
            ->with('success', 'Game deleted successfully.');
    }
}
