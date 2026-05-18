# Elkris Bio Health Blog

A modern, full-featured blog platform for Elkris Bio Health Nigeria Limited, built with Laravel 13.

## Features

- **Content Management**: Full CRUD for blog posts with rich text editing, categories, and tags
- **User Management**: Role-based access control (Admin, Author, Restricted)
- **SEO Optimized**: Custom meta tags, Open Graph, and JSON-LD structured data
- **Reading Experience**: Reading time estimates and scroll progress indicator
- **Newsletter Integration**: Email subscription with validation
- **Contact System**: Visitor contact form with admin notification
- **Shareable Links**: Copy link functionality for easy post sharing (post view and admin dashboard)
- **Responsive Design**: Mobile-first approach with Material Design 3 principles

## Tech Stack

- **Framework**: Laravel 13
- **PHP**: 8.4
- **Database**: SQLite (configurable)
- **Styling**: Tailwind CSS 3
- **Icons**: Material Symbols
- **Rich Text**: Tiptap Editor
- **Testing**: Pest 4

## Installation

```bash
# Clone the repository
git clone <repository-url>
cd elkris-blog

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Start development server
php artisan dev
```

## Development

```bash
# Run tests
php artisan test

# Format code
./vendor/bin/pint

# Build assets
npm run build
```

## Project Structure

- `app/Models/` - Eloquent models (Post, Category, Tag, User, ContactMessage, Subscriber)
- `app/Http/Controllers/` - HTTP controllers
- `resources/views/` - Blade templates
- `database/migrations/` - Database schema
- `routes/` - Application routes

## License

MIT