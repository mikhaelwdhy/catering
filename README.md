# CateringKu - Sistem Pemesanan Paket Catering & Acara (Laravel 12)

Aplikasi berbasis web menggunakan **PHP Laravel**, **Laravel Breeze**, **Blade**, **Tailwind CSS**, dan **MySQL** untuk mengelola kategori paket catering, kuota produksi harian, batas minimal pesanan (MOQ), aturan pemesanan minimal H-2, serta verifikasi pesanan berbasis role (`admin` dan `user`).

## Skema Relasi Tabel

Database menggunakan 6 tabel utama pada MySQL (`db_catering_app`):

- **`users`** (`id`, `name`, `email`, `password`, `role`, `phone`, `created_at`, `updated_at`)
    - Memiliki relasi **One-to-Many** ke `orders` (`user_id`).
- **`categories`** (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`)
    - Memiliki relasi **One-to-Many** ke `packages` (`category_id`).
- **`packages`** (`id`, `category_id`, `name`, `description`, `price`, `min_order`, `daily_quota`, `image`, `created_at`, `updated_at`)
    - Milik satu `categories` (`category_id` -> `categories.id`).
    - Memiliki relasi **One-to-Many** ke `orders` (`package_id`).
- **`orders`** (`id`, `order_code`, `user_id`, `package_id`, `event_name`, `event_date`, `event_address`, `portions`, `price_per_portion`, `total_price`, `penalty_fee`, `payment_proof`, `status`, `notes`, `admin_note`, `created_at`, `updated_at`)
    - Milik satu `users` (`user_id` -> `users.id`) dan satu `packages` (`package_id` -> `packages.id`).
- **`cache`** & **`jobs`**
    - Tabel pendukung cache dan queue bawaan Laravel.

## Langkah Instalasi

1. Clone repository ini lalu masuk ke folder project:
    ```bash
    git clone <URL_REPOSITORY_GITHUB_ANDA>
    cd catering-app
    ```
