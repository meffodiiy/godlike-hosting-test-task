<?php

namespace Tests\Unit;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_game_has_the_correct_fillable_attributes()
    {
        $game = new Game();
        
        $this->assertEquals([
            'title',
            'developer',
            'genre',
            'release_date',
            'platform',
            'price',
            'cover_image'
        ], $game->getFillable());
    }
    
    #[Test]
    public function release_date_is_cast_to_date()
    {
        $game = Game::factory()->create([
            'release_date' => '2023-01-01'
        ]);
        
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $game->release_date);
        $this->assertEquals('2023-01-01', $game->release_date->format('Y-m-d'));
    }
    
    #[Test]
    public function price_is_cast_to_decimal()
    {
        $game = Game::factory()->create([
            'price' => 19.99
        ]);
        
        $this->assertEquals(19.99, $game->price);
        $this->assertIsNumeric($game->price);
    }
    
    #[Test]
    public function a_game_can_be_created_with_all_required_attributes()
    {
        $gameData = [
            'title' => 'Test Game',
            'developer' => 'Test Developer',
            'genre' => 'Action',
            'release_date' => '2023-01-01',
            'platform' => 'PC',
            'price' => 29.99
        ];
        
        $game = Game::create($gameData);
        
        $this->assertInstanceOf(Game::class, $game);
        
        // Adjust the date format for database comparison
        $this->assertDatabaseHas('games', [
            'title' => 'Test Game',
            'developer' => 'Test Developer',
            'genre' => 'Action',
            'platform' => 'PC',
            'price' => 29.99
        ]);
        
        // Check the date separately to avoid format issues
        $this->assertEquals('2023-01-01', $game->release_date->format('Y-m-d'));
    }
}
