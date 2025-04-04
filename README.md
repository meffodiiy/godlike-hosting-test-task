# Game Catalog

A web application for managing a catalog of video games. This application allows you to create, read, update, and delete game entries, complete with cover images, filtering, and search functionality.

## Features

- Browse a catalog of games with cover images
- Search games by title, developer, genre, or platform
- Filter games by genre and platform
- Create new game entries with cover images
- Edit existing game entries
- Delete game entries
- Full responsive design with a modern dark theme

## Requirements

- PHP 8.2 or higher
- Composer
- SQLite or MySQL database
- Node.js and NPM (for frontend assets)
- GD library for PHP (for image manipulation)

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd godlike-hosting-jobinterview
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Create a copy of the environment file:
```bash
cp .env.example .env
```

5. Generate an application key:
```bash
php artisan key:generate
```

6. Create the SQLite database:
```bash
touch database/database.sqlite
```

7. Update the `.env` file with your database configuration:
```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

8. Run migrations to create the database tables:
```bash
php artisan migrate
```

9. Create a symbolic link to the storage directory:
```bash
php artisan storage:link
```

10. Seed the database with sample games:
```bash
php artisan db:seed --class=GameSeeder
```

11. Build frontend assets:
```bash
npm run build
```

## Running the Application

1. Start the development server:
```bash
php artisan serve
```

2. Visit `http://localhost:8000` in your browser

## Development

To run the application in development mode with hot reloading:

```bash
npm run dev
```

In a separate terminal:
```bash
php artisan serve
```

## Testing

Run the automated tests:

```bash
php artisan test
```

## Project Structure

- `app/Models/Game.php` - Game model definition
- `app/Http/Controllers/GameController.php` - Controller for CRUD operations
- `database/migrations/` - Database structure definitions
- `database/seeders/GameSeeder.php` - Seeder for sample data
- `resources/views/games/` - Blade templates for the views
- `public/storage/game-covers/` - Storage location for game cover images
- `tests/` - Unit and feature tests
