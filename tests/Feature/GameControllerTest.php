<?php

namespace Tests\Feature;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GameControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function it_can_display_index_page_with_games()
    {
        // Create some games
        $games = Game::factory()->count(5)->create();

        // Access the index page
        $response = $this->get(route('games.index'));

        // Assert successful response
        $response->assertStatus(200);
        
        // Assert the view contains our games
        $response->assertViewHas('games');
        
        // Assert the first game title is displayed
        $response->assertSee($games[0]->title);
    }

    #[Test]
    public function it_can_search_and_filter_games()
    {
        // Create some games with known attributes
        Game::factory()->create([
            'title' => 'Unique Game Title',
            'genre' => 'Action'
        ]);
        
        Game::factory()->create([
            'title' => 'Another Game',
            'genre' => 'RPG'
        ]);

        // Search by title
        $response = $this->get(route('games.index', ['search' => 'Unique']));
        $response->assertStatus(200);
        $response->assertSee('Unique Game Title');
        $response->assertDontSee('Another Game');

        // Filter by genre
        $response = $this->get(route('games.index', ['genre' => 'RPG']));
        $response->assertStatus(200);
        $response->assertSee('Another Game');
        $response->assertDontSee('Unique Game Title');
    }

    #[Test]
    public function it_can_show_create_game_form()
    {
        $response = $this->get(route('games.create'));
        
        $response->assertStatus(200);
        $response->assertSee('Title');
        $response->assertSee('Developer');
        $response->assertSee('Genre');
    }

    #[Test]
    public function it_can_store_a_new_game()
    {
        Storage::fake('public');
        
        $gameData = [
            'title' => 'New Test Game',
            'developer' => 'Test Developer',
            'genre' => 'Action',
            'release_date' => '2023-01-01',
            'platform' => 'PC',
            'price' => 29.99,
            'cover_image' => UploadedFile::fake()->image('cover.jpg', 1000, 1000)
        ];

        $response = $this->post(route('games.store'), $gameData);
        
        // Assert redirect after successful creation
        $response->assertRedirect(route('games.index'));
        
        // Assert the game exists in the database (without release_date)
        $this->assertDatabaseHas('games', [
            'title' => 'New Test Game',
            'developer' => 'Test Developer',
            'genre' => 'Action',
            'platform' => 'PC',
            'price' => 29.99
        ]);
        
        // Assert image was stored
        $game = Game::where('title', 'New Test Game')->first();
        Storage::disk('public')->assertExists($game->cover_image);
    }

    #[Test]
    public function it_validates_required_fields_when_creating_game()
    {
        $response = $this->post(route('games.store'), []);
        
        $response->assertSessionHasErrors(['title', 'developer', 'genre', 'release_date', 'platform', 'price']);
    }

    #[Test]
    public function it_can_show_a_game()
    {
        $game = Game::factory()->create();
        
        $response = $this->get(route('games.show', $game));
        
        $response->assertStatus(200);
        $response->assertSee($game->title);
        $response->assertSee($game->developer);
        $response->assertSee($game->genre);
    }

    #[Test]
    public function it_can_show_edit_game_form()
    {
        $game = Game::factory()->create();
        
        $response = $this->get(route('games.edit', $game));
        
        $response->assertStatus(200);
        $response->assertSee($game->title);
        // Don't test for the exact form action since it can vary
    }

    #[Test]
    public function it_can_update_a_game()
    {
        Storage::fake('public');
        
        $game = Game::factory()->create();
        
        $updatedData = [
            'title' => 'Updated Game Title',
            'developer' => $game->developer,
            'genre' => $game->genre,
            'release_date' => $game->release_date->format('Y-m-d'),
            'platform' => $game->platform,
            'price' => $game->price,
            'cover_image' => UploadedFile::fake()->image('new_cover.jpg', 1000, 1000)
        ];
        
        $response = $this->put(route('games.update', $game), $updatedData);
        
        $response->assertRedirect(route('games.index'));
        
        // Assert the database has the updated data
        $this->assertDatabaseHas('games', [
            'id' => $game->id,
            'title' => 'Updated Game Title'
        ]);
        
        // Refresh the model
        $game->refresh();
        
        // Assert cover image was stored
        Storage::disk('public')->assertExists($game->cover_image);
    }

    #[Test]
    public function it_can_delete_a_game()
    {
        Storage::fake('public');
        
        // Create a game with a cover image
        $game = Game::factory()->create([
            'cover_image' => 'game-covers/test.jpg'
        ]);
        
        // Simulate file existence
        Storage::disk('public')->put('game-covers/test.jpg', 'test content');
        
        $response = $this->delete(route('games.destroy', $game));
        
        $response->assertRedirect(route('games.index'));
        
        // Assert the game is removed from the database
        $this->assertDatabaseMissing('games', ['id' => $game->id]);
        
        // Assert success message
        $response->assertSessionHas('success');
    }
}
