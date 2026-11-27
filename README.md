# CateringKu - Sistem Pemesanan Paket Catering 

Aplikasi berbasis web menggunakan **Laravel**, **Laravel Breeze**, **Blade**, **Tailwind CSS**, dan **MySQL** untuk mengelola kategori paket catering, kuota produksi harian, batas minimal pesanan (MOQ), aturan pemesanan minimal H-2, serta verifikasi pesanan berbasis role (`admin` dan `user`).

## Skema Relasi Tabel

- **`users`** (`id`, `name`, `email`, `password`, `role`, `phone`)
    - Memiliki relasi **One-to-Many** ke `orders`.
- **`categories`** (`id`, `name`, `description`, `price`, `min_order`, `daily_quota`)
    - Memiliki relasi **One-to-Many** ke `packages`.
- **`packages`** (`id`, `category_id`, `name`, `description`, `price`, `min_order`, `daily_quota`, `image`)
    - Memiliki relasi **One-to-Many** ke `orders`.
- **`orders`** (`id`, `order_code`, `user_id`, `package_id`, `event_name`, `event_date`, `event_address`, `portions`, `price_per_portion`, `total_price`, `penalty_fee`, `payment_proof`, `status`, `notes`, `admin_note`)

## Langkah Instalasi

1. Jalankan perintah berikut di terminal dan berlokasi di folder project:
    ```bash
    git clone <URL_REPOSITORY_GITHUB_ANDA>
    cd catering-app
    composer install
    npm install
    buka file .env dan sesusaikan pengaturan koneksi database
    php artisan migrate --seed
    php artisan storage:link
    npm run build
    php artisan serve
    ```

## Akun Demo

    admin@catering.test / password
    budi@catering.test / password
    agus@catering.test / password
