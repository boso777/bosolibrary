# Specifiche Tecniche e Guida all'Ottimizzazione - BosoLibrary

Questo documento descrive lo stack tecnologico, le dipendenze e le configurazioni ottimali per l'hosting del progetto **BosoLibrary**.

## 🚀 Stack Tecnologico

### Backend
- **Framework:** Laravel 13.x
- **Linguaggio:** PHP 8.4+ (Consigliato 8.4 per compatibilità con le ultime feature)
- **Autenticazione:** Laravel Fortify (Headless Auth)
- **Database:** MariaDB (o MySQL 8.0+)
- **Testing:** Pest 4.x

### Frontend
- **Reattività:** Livewire 4.x (Full-stack components)
- **Styling:** TailwindCSS 4.x (Utility-first) + Bootstrap 5.3 (per componenti legacy/specifici)
- **Bundler:** Vite 8.x
- **Librerie Specifiche:**
    - `epubjs`: Rendering di ebook in formato EPUB.
    - `pdf.js`: Visualizzazione documenti PDF (integrata in `public/pdfjs`).
    - `jszip`: Gestione file compressi.

---

## 🛠 Requisiti del Server

Per garantire prestazioni ottimali, il server deve soddisfare i seguenti requisiti:

### PHP Extensions
Assicurarsi che le seguenti estensioni siano installate e attive:
- `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `gd`, `hash`, `iconv`, `intl`, `json`, `libxml`, `mbstring`, `openssl`, `pcre`, `pdo_mysql`, `session`, `tokenizer`, `xml`, `xmlreader`, `xmlwriter`, `zip`, `zlib`.

### Servizi Accessori
- **Redis:** Fortemente raccomandato per la gestione della cache, delle sessioni e delle code (Queue).
- **Supervisor:** Necessario per mantenere attivo il worker delle code (`php artisan queue:work`).
- **Cron:** Necessario per lo scheduling di Laravel (`php artisan schedule:run`).

---

## ⚡ Ottimizzazioni Lato Server

### 1. Ottimizzazione PHP (php.ini)
Per un'applicazione Laravel 13 con Livewire 4, configurare OPcache per massimizzare le performance:

```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.revalidate_freq=0 ; Impostare a 0 in produzione
opcache.validate_timestamps=0 ; Disabilitare in produzione per massime performance
```

### 2. Comandi di Deployment (Produzione)
Eseguire sempre questi comandi durante il deploy per ottimizzare il framework:

```bash
# Ottimizza l'autoloader di Composer
composer install --optimize-autoloader --no-dev

# Caching della configurazione e delle rotte
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Compilazione degli asset frontend
npm run build
```

### 3. Gestione Code (Queue)
BosoLibrary potrebbe gestire operazioni pesanti (es. processamento di file PDF/Epub). Utilizzare Redis come driver per le code e configurare Supervisor:

```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/project/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/project/storage/logs/worker.log
```

### 4. Configurazione Web Server (Nginx)
Esempio di configurazione per gestire correttamente le rotte di Laravel e gli asset di Vite:

```nginx
server {
    listen 80;
    server_name example.com;
    root /path/to/project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## 📦 Gestione File e Storage
Il progetto utilizza i dischi di storage per i libri e le copertine:
- Assicurarsi che la cartella `storage` e `bootstrap/cache` siano scrivibili dal server web (`www-data`).
- Eseguire `php artisan storage:link` per rendere pubblici i file in `storage/app/public`.

---

## 📈 Monitoraggio
Si consiglia l'utilizzo di **Laravel Pulse** (se installato) o monitoraggio esterno per controllare l'utilizzo di CPU/Memoria, specialmente durante il rendering di ebook pesanti via browser.
