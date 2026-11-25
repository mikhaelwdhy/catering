<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin & Minimal 2 Akun User
        $admin = User::create([
            'name' => 'Admin CateringKu',
            'email' => 'admin@catering.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081200000001',
        ]);

        $user1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@catering.test',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567890',
        ]);

        $user2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@catering.test',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081298765432',
        ]);

        // 2. Kategori Paket
        $catPrasmanan = Category::create([
            'name' => 'Prasmanan Pernikahan & Acara',
            'slug' => 'prasmanan-pernikahan-acara',
            'description' => 'Layanan prasmanan lengkap dengan peralatan pemanas, piring, dan pramusaji.',
        ]);

        $catNasiBox = Category::create([
            'name' => 'Nasi Box Seminar & Rapat',
            'slug' => 'nasi-box-seminar-rapat',
            'description' => 'Kemasan box higienis dan praktis untuk acara kantor, seminar, dan kampus.',
        ]);

        $catSnack = Category::create([
            'name' => 'Coffee Break & Snack Box',
            'slug' => 'coffee-break-snack-box',
            'description' => 'Aneka kue tradisional, pastry, kopi, dan teh untuk jeda acara.',
        ]);

        // 3. Data Master Paket Catering
        $pkg1 = Package::create([
            'category_id' => $catPrasmanan->id,
            'name' => 'Paket Prasmanan Nusantara Gold',
            'description' => 'Nasi Putih, Nasi Goreng Oriental, Ayam Bakar Madu, Rendang Daging, Sop Kimlo, Capcay, Kerupuk, Buah Potong, Es Teh Manis.',
            'price' => 65000,
            'min_order' => 100,
            'daily_quota' => 400,
        ]);

        $pkg2 = Package::create([
            'category_id' => $catNasiBox->id,
            'name' => 'Nasi Box Eksekutif Ayam Geprek Sambal Matah',
            'description' => 'Nasi Putih Pulen, Ayam Fillet Geprek Sambal Matah, Tahu Tempe Bacem, Lalapan Segar, Air Mineral Gelas.',
            'price' => 28000,
            'min_order' => 30,
            'daily_quota' => 250,
        ]);

        $pkg3 = Package::create([
            'category_id' => $catSnack->id,
            'name' => 'Paket Coffee Break Premium (3 Kue + Minum)',
            'description' => 'Risoles Mayo, Lemper Ayam, Brownies Kukus, Kopi Hitam, Teh Manis Hangat.',
            'price' => 22000,
            'min_order' => 25,
            'daily_quota' => 40,
        ]);

        // 4. Contoh Transaksi Awal
        Order::create([
            'order_code' => 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4)),
            'user_id' => $user1->id,
            'package_id' => $pkg1->id,
            'event_name' => 'Resepsi Pernikahan Keluarga Budi',
            'event_date' => Carbon::today()->addDays(7)->toDateString(),
            'event_address' => 'Gedung Serbaguna Melati, Jl. Sudirman No. 45',
            'portions' => 120,
            'price_per_portion' => $pkg1->price,
            'total_price' => 120 * $pkg1->price,
            'status' => 'Pending',
            'notes' => 'Mohon disiapkan meja VIP untuk keluarga inti.',
        ]);

        Order::create([
            'order_code' => 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4)),
            'user_id' => $user2->id,
            'package_id' => $pkg2->id,
            'event_name' => 'Workshop Digital Marketing Kampus',
            'event_date' => Carbon::today()->addDays(5)->toDateString(),
            'event_address' => 'Aula Utama Gedung Rektorat Lt. 3',
            'portions' => 50,
            'price_per_portion' => $pkg2->price,
            'total_price' => 50 * $pkg2->price,
            'status' => 'Approved',
            'admin_note' => 'Pembayaran terverifikasi. Jadwal produksi masuk antrean.',
        ]);
    }
}