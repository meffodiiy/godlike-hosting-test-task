<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $games = $query->latest()->paginate(12);
        
        // Preserve query parameters in pagination links
        $games->appends(request()->query());

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
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'developer' => 'required|max:255',
            'genre' => 'required|max:255',
            'release_date' => 'required|date',
            'platform' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('game-covers', 'public');
        }

        Game::create($validatedData);

        return redirect()->route('games.index')->with('success', 'Game created successfully.');
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
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'developer' => 'required|max:255',
            'genre' => 'required|max:255',
            'release_date' => 'required|date',
            'platform' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($game->cover_image) {
                Storage::disk('public')->delete($game->cover_image);
            }
            $validatedData['cover_image'] = $request->file('cover_image')->store('game-covers', 'public');
        }

        $game->update($validatedData);

        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
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
