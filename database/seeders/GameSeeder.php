<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use Carbon\Carbon;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Action', 'Adventure', 'RPG', 'Strategy', 'Sports', 
            'Simulation', 'Racing', 'Puzzle', 'Horror', 'Fighting',
            'Shooter', 'Platform', 'MMORPG', 'Battle Royale', 'Survival'
        ];

        $developers = [
            'Rockstar Games', 'Electronic Arts', 'Ubisoft', 'Nintendo', 'Sony Interactive',
            'Bethesda', 'CD Projekt Red', 'Square Enix', 'Valve', 'Blizzard',
            'FromSoftware', 'Capcom', 'SEGA', 'Naughty Dog', 'BioWare'
        ];

        $platforms = [
            'PC', 'PlayStation 5', 'Xbox Series X|S', 'Nintendo Switch',
            'PlayStation 4', 'Xbox One', 'Mobile', 'Multiple'
        ];

        $gamePrefixes = [
            'The Legend of', 'Rise of', 'Dark', 'Super', 'Ultimate',
            'Epic', 'Eternal', 'Lost', 'Ancient', 'Cyber',
            'Star', 'Project', 'Chronicles of', 'Beyond', 'Final'
        ];

        $gameWords = [
            'Warriors', 'Quest', 'Fantasy', 'World', 'Empire',
            'Legacy', 'Legends', 'Heroes', 'Souls', 'Dreams',
            'Galaxy', 'Kingdom', 'Realms', 'Dawn', 'Destiny'
        ];

        for ($i = 0; $i < 100; $i++) {
            // Generate a random release date between 2 years ago and 1 year in the future
            $releaseDate = Carbon::now()->subYears(2)->addDays(rand(0, 1095));
            
            // Generate a random price between $19.99 and $69.99
            $price = rand(1999, 6999) / 100;
            
            // Generate a unique game title
            $title = $gamePrefixes[array_rand($gamePrefixes)] . ' ' . 
                    $gameWords[array_rand($gameWords)] . ' ' . 
                    rand(1, 5);

            Game::create([
                'title' => $title,
                'developer' => $developers[array_rand($developers)],
                'genre' => $genres[array_rand($genres)],
                'platform' => $platforms[array_rand($platforms)],
                'release_date' => $releaseDate,
                'price' => $price
            ]);
        }
    }
}
