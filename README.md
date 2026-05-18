# YouLib
YouLib is a technical implementation of a digital library management system designed for hosting, organizing, and reading electronic publications. The project leverages the Laravel ecosystem to provide a high-performance, reactive user experience.

## Technical Stack
The application is built using the following core technologies:
*   **Language**: PHP 8.3+
*   **Framework**: Laravel 13
*   **Reactive UI**: Livewire 4 & Alpine.js
*   **Styling**: Tailwind CSS 4
*   **Authentication**: Laravel Fortify (Frontend-agnostic auth backend)
*   **Asset Bundling**: Vite 8
*   **Testing**: Pest 4
*   **E-book Rendering**: EPUB.js, PDF.js, and JSZip
*   **Containerization**: Laravel Sail, Docker

## Core Features

### 1. Publication Management
*   Full CRUD operations for books and categories.
*   Polymorphic attachment system for handling various file formats.
*   Category-based filtering and organization.

### 2. Multi-Format Reader
Integrated web-based readers for:
*   **EPUB**: Powered by `epubjs` for reflowable content.
*   **PDF**: Utilizing `pdf.js` for high-fidelity document rendering.
*   **PPTX**: Custom handling for presentation previews.

### 3. Architecture
The project follows standard Laravel conventions with a focus on:
*   **Service-driven logic**: Decoupling business logic from controllers.
*   **Reactive Components**: Using Livewire for real-time UI updates without full page reloads.
*   **Database Schema**: Relational structure with support for many-to-many relationships (Books/Categories).

## Prerequisites
*   Docker & Docker Compose
*   PHP >= 8.3 (for initial Composer bootstrap only)
*   Composer

> All other dependencies (Node.js, NPM, SQLite/MySQL) are managed inside the Sail container.

## Installation

### 1. Clone the repository
```bash
git clone <repository-url>
cd youlib
```

### 2. Install Sail dependencies (host machine)
```bash
composer install --ignore-platform-reqs
```

### 3. Environment Setup
```bash
cp .env.example .env
```

### 4. Start containers and run full setup
```bash
./vendor/bin/sail up -d
make setup
```

This single command installs all PHP and frontend dependencies, publishes Fortify config, generates the app key, runs migrations, and links storage.

## Makefile Shortcuts

The project includes a `Makefile` for common development tasks:

| Command | Description |
|---|---|
| `make setup` | Full first-time setup inside the container |
| `make up` | Start containers and run the Vite dev server |
| `make down` | Stop all containers |
| `make fresh` | Re-run migrations with fresh seed data |
| `make start` | Start containers and run full setup in one command |

## Development

Start the environment with:
```bash
make up
```

The application will be accessible at `http://localhost:8000`. Hot-reloading via Vite is included.

## License
This project is open-sourced software.
