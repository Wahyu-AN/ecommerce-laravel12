# AGENTS.md

## Tujuan Project
Website e-commerce responsif berbasis Laravel 12 untuk project "Ecommerce Wahyu".
Fokus: mudah dipakai, mobile-first, aman, stabil, mudah dikembangkan.

## Stack Teknologi
- PHP 8.2+
- Laravel 12
- SQLite (dev) / MySQL (production)
- Blade + Tailwind CSS + Alpine.js
- Laravel Breeze (auth)
- Laravel Pint (code style)
- Pest (testing)

## Aturan Utama untuk AI
1. WAJIB baca file berikut sebelum menulis kode:
   - AGENTS.md
   - docs/PRD.md
   - docs/ARCHITECTURE.md
   - docs/CODING_STANDARDS.md
   - docs/DATABASE_SCHEMA.md
   - docs/ROADMAP.md

2. Prioritas jika instruksi bertentangan:
   1. AGENTS.md
   2. docs/CODING_STANDARDS.md
   3. docs/DATABASE_SCHEMA.md
   4. Permintaan user eksplisit

3. Jika informasi kurang, AI harus bertanya (maks 3 pertanyaan) sebelum coding.

4. AI TIDAK BOLEH:
   - Mengubah file di luar scope tugas
   - Menambah package Composer/NPM tanpa persetujuan
   - Menghapus fitur yang sudah ada
   - Menggunakan kode deprecated
   - Membuat float untuk harga
   - Mempercayai harga dari frontend

5. AI WAJIB:
   - Validasi semua input di server
   - Mobile-first responsive
   - Hitung total di backend
   - Gunakan DB transaction untuk operasi penting
   - Ikuti format jawaban standar

## Format Jawaban AI
Setiap kali memberikan kode, AI harus menyediakan:
1. Ringkasan perubahan
2. Daftar file yang diubah/dibuat
3. Kode lengkap per file
4. Perintah artisan yang perlu dijalankan
5. Cara manual test fitur
6. Catatan risiko

## Definition of Done
Fitur selesai jika:
1. Kode mengikuti standar project
2. Migration bisa dijalankan
3. Tidak merusak fitur lama
4. Responsif mobile/tablet/desktop
5. Validasi input bekerja
6. Test minimal ditambahkan
7. User bisa uji manual

## Struktur Folder
```
app/
  Http/Controllers/Admin/    <- panel admin
  Http/Controllers/Shop/     <- storefront publik
  Http/Requests/
  Models/
  Services/                  <- logika bisnis
  Enums/
  Policies/
resources/views/
  components/
  layouts/
  shop/                      <- view publik
  admin/                     <- view admin
docs/
.ai/
```

## Penamaan
- Model: singular (`Product`, `Order`)
- Controller: singular (`ProductController`)
- Table: plural snake_case (`products`, `order_items`)
- Route name: dot notation (`shop.products.show`, `admin.orders.index`)
- Service: akhiran Service (`CartService`, `CheckoutService`)

## Aturan Uang
- Harga = integer dalam Rupiah
- Tidak boleh float
- Format: `Rp {{ number_format($price, 0, ',', '.') }}`
- Diskon dan total dihitung di backend

## Keamanan
- Wajib CSRF untuk semua form
- Middleware `auth` dan `admin` untuk area admin
- Validasi file upload (tipe & ukuran)
- Jangan tampilkan error sensitif ke user