setup:
	./vendor/bin/sail composer install
	./vendor/bin/sail npm install
	./vendor/bin/sail npm install tailwindcss @tailwindcss/vite
	./vendor/bin/sail npm install jszip epubjs
	./vendor/bin/sail artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
	./vendor/bin/sail artisan key:generate
	./vendor/bin/sail artisan migrate
	./vendor/bin/sail artisan storage:link


up:
	./vendor/bin/sail up -d
	./vendor/bin/sail npm run dev

down:
	./vendor/bin/sail down

fresh:
	./vendor/bin/sail artisan migrate:fresh --seed

start:
	./vendor/bin/sail up -d
	make setup