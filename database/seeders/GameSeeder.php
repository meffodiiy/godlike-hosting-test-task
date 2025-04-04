<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting game seeder...');
        
        // Make sure the storage directory exists
        Storage::disk('public')->makeDirectory('game-covers');

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
        
        // Create a set of placeholder images with different colors
        $colors = ['FF5733', '33FF57', '3357FF', 'F3FF33', 'FF33F3', '33FFF3', 'FF3333', '33FF33'];
        $coverImages = [];
        
        $this->command->info('Creating placeholder images...');
        
        foreach ($colors as $index => $color) {
            $imagePath = "game-covers/placeholder-{$index}.png";
            
            // Create a simple colored image
            $image = imagecreatetruecolor(800, 600);
            $colorCode = hexdec($color);
            $fillColor = imagecolorallocate(
                $image,
                ($colorCode >> 16) & 0xFF,
                ($colorCode >> 8) & 0xFF,
                $colorCode & 0xFF
            );
            imagefill($image, 0, 0, $fillColor);
            
            // Add some text
            $textColor = imagecolorallocate($image, 255, 255, 255);
            imagestring($image, 5, 350, 290, "Game Cover", $textColor);
            
            // Save the image
            ob_start();
            imagepng($image);
            $imageData = ob_get_clean();
            imagedestroy($image);
            
            Storage::disk('public')->put($imagePath, $imageData);
            $coverImages[] = $imagePath;
            
            $this->command->info("Created placeholder image {$index}");
        }
        
        $this->command->info('Creating games...');
        
        for ($i = 0; $i < 50; $i++) {
            // Generate a random release date between 2 years ago and 1 year in the future
            $releaseDate = Carbon::now()->subYears(2)->addDays(rand(0, 1095));
            
            // Generate a random price between $19.99 and $69.99
            $price = rand(1999, 6999) / 100;
            
            // Generate a unique game title
            $title = $gamePrefixes[array_rand($gamePrefixes)] . ' ' . 
                    $gameWords[array_rand($gameWords)] . ' ' . 
                    rand(1, 5);
            
            // Select a random cover image from our set
            $coverImage = $coverImages[array_rand($coverImages)];

            Game::create([
                'title' => $title,
                'developer' => $developers[array_rand($developers)],
                'genre' => $genres[array_rand($genres)],
                'platform' => $platforms[array_rand($platforms)],
                'release_date' => $releaseDate,
                'price' => $price,
                'cover_image' => $coverImage
            ]);
            
            if (($i + 1) % 10 === 0) {
                $this->command->info("Created " . ($i + 1) . " games so far...");
            }
        }
        
        $this->command->info('Game seeding complete. Added 50 games with images.');
    }
}
