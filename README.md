<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Ringkasan Proyek Rafting Booking (Laravel + MySQL)

Aplikasi SPA booking rafting dengan 4 role: `admin`, `ojek_perahu`, `rescue`, `user`. Fitur meliputi CRUD konten, paket, boat, operator, rescue, booking & orders, rotasi operator round-robin, pembayaran QRIS (simulasi webhook), notifikasi rescue (polling), dan data demo via seeder.

### Langkah Setup
- Salin `.env.example` ke `.env` dan set koneksi database.
- Jalankan migrasi: `php artisan migrate`.
- Jalankan seeder demo: `php artisan db:seed`.
- Jalankan server dev: `php artisan serve`.
- Opsional SPA: `npm install && npm run dev` (UI Vue 3 akan ditambahkan).

### Environment Vars (Simulasi QRIS)
- `QRIS_ENABLED=true|false` (opsional; juga bisa set via endpoint admin config).
- `PAY_ON_SITE_ENABLED=true|false`.

### Endpoint Utama (API)
- `POST /api/bookings` — buat booking (role: user).
- `GET /api/bookings/{id}` — detail booking (role: user pemilik).
- `POST /api/payment/intent/{booking}` — buat intent QRIS.
- `POST /api/payment/webhook` — webhook simulasi update status.
- `GET /api/payment/status/{booking}` — cek status pembayaran.
- `POST /api/orders` — buat order.
- `POST /api/rotation/assign/{order}` — assign operator round-robin.
- `GET /api/operator/dashboard` — ringkasan KPI operator.
- `GET /api/operator/tasks` — daftar tugas operator.
- `GET /api/rescue/dashboard` — ringkasan notifikasi rescue.
- `GET /api/rescue/notifications` — polling notifikasi rescue.
- `POST /api/rescue/confirm` — rescue set on-call.
- `POST /api/rescue/complete/{order}` — tandai tugas selesai.
- Admin CRUD: `api/admin/posts|packages|boats|operators|rescue` (apiResource).
- Admin: `GET api/admin/reports/bookings|orders` (filter via query `from`,`to`,`package_id`,`assigned_operator_id`).
- Admin: `POST api/admin/config/payment` — set `qris_enabled`, `pay_on_site_enabled`.
- Admin: `POST api/admin/seed/demo` — jalankan seeder dari UI.

### Model & Relasi
- Users: `role`, `profile` JSON, relasi `bookings`, `operator`, `rescueMember`.
- Posts, Packages, Boats, Operators, RescueTeam, Bookings, Orders, ScheduleRotation, Notifications.
- Relasi: Booking belongsTo User & Package; Order belongsTo Booking & Operator.

### Rotasi Round-Robin
- Tabel `schedule_rotation` menyimpan `pointer_index` dan `last_assigned_operator_id`.
- Endpoint assign memilih operator aktif berikutnya, mempertimbangkan `max_tugas_per_hari`.

### Testing
- Unit: `tests/Unit/RotationTest.php` memastikan round-robin berjalan.
- Feature: `tests/Feature/BookingPaymentTest.php` untuk alur booking & pembayaran.

### Acceptance Checklist
- [ ] Admin CRUD posts/packages/boats/operators/rescue.
- [ ] Rotasi operator round-robin sesuai urutan dan kapasitas harian.
- [ ] Booking menahan kapasitas paket di tanggal yang dipilih.
- [ ] Payment QRIS dapat berubah status via webhook simulasi.
- [ ] Rescue menerima notifikasi (poll) dan konfirmasi tugas.
- [ ] Semua controller, migration, seeder tersedia.
- [ ] UI responsive dan modern (SPA) — pending setup.

### Catatan
- Middleware `role` membatasi akses per role.
- Beberapa validasi dilakukan di controller; dapat ditingkatkan ke Form Request.
- Konfigurasi pembayaran disimpan sementara via runtime config untuk demo.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
