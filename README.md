# BosoLibrary

BosoLibrary is a technical implementation of a digital library management system designed for hosting, organizing, and reading electronic publications. The project leverages the Laravel ecosystem to provide a high-performance, reactive user experience.

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

*   PHP >= 8.3
*   Composer
*   Node.js & NPM
*   SQLite (default) or MySQL/PostgreSQL

## Installation

1.  **Clone the repository**:
    ```bash
    git clone <repository-url>
    cd bosolibrary
    ```

2.  **Install PHP dependencies**:
    ```bash
    composer install
    ```

3.  **Install Frontend dependencies**:
    ```bash
    npm install
    ```

4.  **Environment Setup**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Database Migration**:
    ```bash
    touch database/database.sqlite
    php artisan migrate --seed
    ```

6.  **Storage Link**:
    ```bash
    php artisan storage:link
    ```

## Development

To start the development server with hot-reloading (Vite) and Laravel Pail:

```bash
composer run dev
```

The application will be accessible at `http://localhost:8000`.

## Testing

The project uses Pest for feature and unit testing. Run the suite using:

```bash
composer run test
```

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).
