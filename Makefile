setup:
	sail composer install
	sail npm install
	sail npm install tailwindcss @tailwindcss/vite
	sail composer require laravel/fortify livewire/livewire
	sail artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
	sail artisan key:generate
	sail artisan migrate

up:
	sail up -d

fresh:
	sail artisan migrate:fresh --seed

start:
	sail up -d
	make setup