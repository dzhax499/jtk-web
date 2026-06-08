# JTK Web — Agent Guide

## Project

Laravel 13 + Filament 5 admin panel for Jurusan Teknik Komputer (JTK) POLBAN's department website. PostgreSQL on Supabase (production), SQLite in-memory (tests). Frontend: Blade + vanilla JS + Tailwind CSS v4 via `@import "tailwindcss"`, built with Vite 8.

## Quick start

```bash
composer run setup       # full: install, .env, key:gen, migrate, npm install, npm build
composer run dev         # concurrently: artisan serve (8000) + queue:listen + pail (logs) + vite (5173)
composer run test        # config:clear then phpunit (SQLite :memory:)
```

Individual commands: `php artisan serve`, `./vendor/bin/pint` (lint), `npm run build` / `npm run dev`.

## Critical gotchas

- **Never `migrate:fresh` on Supabase** — destroys all CMS data. All lecturer seeders are incremental (upsert).
- **`.npmrc` sets `ignore-scripts=true`** — npm lifecycle scripts won't run.
- **Tests use SQLite in-memory** (`phpunit.xml` overrides DB_CONNECTION). Config is cleared before each run.

## Architecture

- **Hybrid data fetching**: `/profil-dosen`, `/detail-dosen`, `/program-studi`, `/tentang-jtk` render server-side via `PublicController`. Pages like `/berita`, `/prestasi`, `/akademik`, `/akreditasi`, `/visi-misi` pass empty views; Blade templates fetch data client-side from `/api/*`.
- **API routes** (`routes/api.php`): `/api/pages`, `/api/posts`, `/api/categories`, `/api/media`, `/api/lecturers`, `/api/study-programs`.
- **Web routes** (`routes/web.php`): 27 routes, all handled by `PublicController`.
- **Admin panel** at `/admin` via Filament.

## Filament resources

All follow a **deconstructed modular pattern**:
```
app/Filament/Resources/<Name>/
├── <Name>Resource.php        # routes, nav, delegation
├── Pages/{Create,Edit,List,View}<Name>.php
├── Schemas/<Name>Form.php    # form schema
├── Schemas/<Name>Infolist.php
└── Tables/<Name>Table.php
```
Generate new ones with: `php artisan make:filament-resource <Model> --generate`

## Lecturer data import

CSV files go in `storage/app/imports/Data_Dosen/` (each lecturer a subfolder with `biodata.csv`, `riwayat.csv`, etc.). Import via staged seeders (NOT Artisan commands):

```bash
php artisan db:seed --class=LecturerBiodataOnlySeeder
php artisan db:seed --class=LecturerRiwayatOnlySeeder
php artisan db:seed --class=LecturerPortofolioOnlySeeder
php artisan db:seed --class=LecturerScholarOnlySeeder
php artisan db:seed --class=LecturerScopusOnlySeeder
```

Separate seeders avoid Supabase pooler timeouts. Scopus/scholar data from `storage/app/imports/scrapping_scopus/`.

## Model quirks

- `Post` model has `$guarded = []` + a custom `boot()` that manually assigns sequential IDs (avoids Supabase sequence issues).
- `Lecturer` model has `$casts` for `is_active` (bool) and `raw_data` (array).
- All Filament-managed tables use `Schema::hasTable()` guards in controllers.

## Supabase

If auto-increment sequences fall out of sync:
```sql
SELECT setval(pg_get_serial_sequence('lecturers', 'id'), coalesce(max(id), 1), max(id) IS NOT null) FROM lecturers;
```
Connection uses pooler port 6543, `sslmode=prefer`, `search_path=public`.

## No CI/CD

No workflows, no Dockerfile, no deployment config. No existing instruction files.
