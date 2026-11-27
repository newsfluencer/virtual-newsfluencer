# Virtual Newsfluencer - Backend

## Development setup

`php artisan ...` is Laravel's command-line tool. With Docker, run it inside the app container by putting this in front of the command:

`docker compose -f docker-compose.dev.yml exec app`

So `php artisan migrate` becomes `docker compose -f docker-compose.dev.yml exec app php artisan migrate`. The steps below only show the `php artisan ...` part.

### With Docker

I recommend you install Docker Desktop before continuing these steps.

1. Copy `.env.example` to `.env`
2. Set `API_ACCESS_KEY` (shared secret the frontend must send on every request)
3. Set `DB_PASSWORD` (Postgres password)
4. Set `NEWS_API_KEY` for real news articles
5. Start the stack with `docker compose -f docker-compose.dev.yml up --build`. This builds the image and starts the API and database
6. Run this command once: `php artisan key:generate` (creates the app encryption key in `.env`)
7. Run this command once: `php artisan storage:link` (makes uploaded/public files reachable over HTTP)
8. Set up the database tables (see Database section below).
9. Stop everything with `docker compose -f docker-compose.dev.yml down`

### Without Docker

You need PHP 8.3+ (8.5 recommended), Composer, and a local Postgres database installed first. I recommend you install [Lerd](https://lerd.sh) for a faster and easier setup.

1. Copy `.env.example` to `.env`
2. Set `API_ACCESS_KEY` (shared secret the frontend must send on every request).
3. Set `DB_*` values for your local Postgres
4. Set `NEWS_API_KEY` for real news articles
5. Run `composer install` (downloads PHP dependencies into `vendor/`)
6. Run `php artisan key:generate` (creates the app encryption key in `.env`)
7. Run `php artisan migrate` (creates the database tables)
8. Run `php artisan storage:link` (makes uploaded/public files reachable over HTTP)
9. Start the API with `php artisan serve`
10. For article imports, run `php artisan queue:work` in a second terminal (processes background jobs)

### Database

1. `php artisan migrate` creates or updates database tables
2. `php artisan migrate:fresh` drops all tables and recreates them (wipes data)
3. `php artisan db:seed` inserts 10 fake articles for local testing
4. `php artisan migrate:fresh --seed` wipes the database, recreates tables, then seeds fake articles

### Queue and schedule

1. `php artisan queue:work` processes waiting background jobs (needed for article imports)
2. `php artisan queue:clear` deletes waiting jobs
3. `php artisan schedule:work` runs scheduled tasks (daily article import at 03:00 UTC)

### Article import

Needs `NEWS_API_KEY` and a running `queue:work`.

- `php artisan process:articles` fetches articles and queues them for saving.

## Connecting the frontend

1. Base URL: `http://localhost:8080` (Docker) or `http://127.0.0.1:8000`
2. Send header `X-Api-Key` with the same value as `API_ACCESS_KEY`
3. Call any of the routes defined in `/routes/api.php`

Wrong or missing key returns `401` with `{"message":"Unauthorized."}`.

Example:
```bash
curl -H "X-Api-Key: your-secret" -H "Accept: application/json" http://localhost:8080/api/articles
```
