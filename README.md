# Nama Aplikasi

## Daftar Isi
- [Daftar Username dan Password](#daftar-username-dan-password)
- [Versi Database](#versi-database)
- [Versi PHP](#versi-php)
- [Framework](#framework)
- [Panduan Penggunaan Aplikasi](#panduan-penggunaan-aplikasi)
- [physical data model] ([https://drive.google.com/file/d/1VDK9bw3bnJFPx4qYupG2R0b19v-MDoHb/view?usp=sharing](https://drive.google.com/file/d/1PxcQcIit8VhNjAm4ATbjNNv6ouC7Dpj8/view?usp=sharing)).
- [activity diagram] (https://drive.google.com/file/d/1Hr929hj2J8yfiTr2Iu2WApHQxKSkVCxB/view?usp=sharing)


## Daftar Username dan Password

Berikut adalah daftar username dan password untuk mengakses aplikasi:

Untuk role admin 
email : admin@admin.com
password : admin123

untuk role kepala bagian email acak bisa dilihat didatabase karena menggunakan seeder fake, untuk password semua sama '12345'

## Versi Database

Aplikasi ini dikembangkan dengan menggunakan MySQL versi 8.0.3.

## Versi PHP

Aplikasi ini memerlukan PHP versi 8.2.0 .

## Framework

Aplikasi ini dibangun dengan menggunakan framework Laravel versi 10.0.

## Panduan Penggunaan Aplikasi

1. **Instalasi:**
    - Pastikan PHP dan MySQL sudah terinstal di komputer Anda.
    - Clone repositori ini ke dalam direktori lokal Anda.

    ```bash
    git clone https://github.com/tesarp1812/sekawan.git
    ```

    - Masuk ke direktori aplikasi.

    ```bash
    cd nama-aplikasi
    ```

    - Install dependensi menggunakan Composer.

    ```bash
    composer install
    ```

    - Salin file `.env.example` menjadi `.env`.

    ```bash
    cp .env.example .env
    ```

    - Sesuaikan konfigurasi database di file `.env` dengan informasi database.

    - Generate aplikasi key.

    ```bash
    php artisan key:generate
    ```

    - Migrasikan basis data ( tambahan --seed agar menjalankan semua seeder yang telah dibuat).

    ```bash 
    php artisan migrate --seed
    ```

2. **Menjalankan Aplikasi:**
    - Jalankan server pengembangan Laravel.

    ```bash
    php artisan serve
    ```

    - Buka browser dan akses `http://localhost:8000`.

3. **Login:**
    - Gunakan username dan password dari [daftar username dan password](#daftar-username-dan-password) untuk login.

