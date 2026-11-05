# Proyek UTS – Website Portofolio

- **Nama** : Cahyadi
- **NIM**  : 202401251027
- **Mata Kuliah** : Pemrograman Web 1 (Dosen: Rahmat Gunawan, M.Kom.)
- **Tautan Vercel** :https://portofolio-uts-woad.vercel.app/

## Struktur Berkas

```
index.html          Halaman utama (statis, dipublikasikan di Vercel)
search.php          Pencarian proyek – memproses GET
kontak.php          Formulir kontak – memproses POST
css/style.css       Seluruh styling (Flexbox + media query)
images/             Foto profil
includes/           Template PHP: header.php, footer.php, data.php
pesan.json          Dibuat otomatis saat ada pesan masuk
```

## Cara Menjalankan PHP Secara Lokal

```bash
php -S localhost:8000
```
Lalu buka `http://localhost:8000/index.html`.
(Vercel tidak menjalankan PHP, sehingga `search.php` dan `kontak.php` hanya berfungsi secara lokal.)

## Bukti Demo PHP

- Tangkapan layar: `bukti/search.png`<img width="1357" height="670" alt="Cuplikan layar 2026-11-05 133635" src="https://github.com/user-attachments/assets/6ef4f562-d5f3-4cb5-8f1a-5cfb359a1163" />
, `bukti/kontak.png`  *(<img width="1346" height="677" alt="Cuplikan layar 2026-11-05 133819" src="https://github.com/user-attachments/assets/c681bb0e-dabc-48e4-970e-aaa079591bf6" />
)*
- Video demo: *(tempel tautan di sini)*

## Fitur

- Elemen semantik: header, nav, main, article, aside, footer
- Tautan LinkedIn di dalam `<nav>`
- Layout Flexbox, responsif dengan media query
- GET: pencarian + pesan "tidak ditemukan" + pagination
- POST: validasi `trim()`, `empty()`, `filter_var()`, output `htmlspecialchars()`
- Template `require` (header/footer), array + `foreach`, fungsi buatan sendiri
- Pesan kontak disimpan ke `pesan.json`
