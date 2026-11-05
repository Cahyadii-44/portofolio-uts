<?php
/**
 * data.php - sumber data proyek + fungsi buatan sendiri.
 * Dipakai oleh search.php. Ganti isi array dengan proyek asli Anda.
 */

$daftarProyek = [
    [
        'judul'     => 'Website Portofolio Pribadi',
        'kategori'  => 'Web',
        'tahun'     => 2026,
        'deskripsi' => 'Website portofolio dengan HTML semantik, CSS, dan layout flexbox yang responsif.',
    ],
    [
        'judul'     => 'Kalkulator Pajak Sederhana',
        'kategori'  => 'PHP',
        'tahun'     => 2026,
        'deskripsi' => 'Formulir PHP yang menghitung pajak penghasilan dasar dari data yang dikirim lewat POST.',
    ],
    [
        'judul'     => 'Landing Page UMKM Kuliner',
        'kategori'  => 'Web',
        'tahun'     => 2025,
        'deskripsi' => 'Halaman promosi untuk usaha kuliner lokal lengkap dengan menu dan tombol pesan.',
    ],
    [
        'judul'     => 'Blog Catatan Kuliah',
        'kategori'  => 'PHP',
        'tahun'     => 2025,
        'deskripsi' => 'Daftar catatan kuliah yang ditampilkan dari array PHP memakai perulangan foreach.',
    ],
    [
        'judul'     => 'Daftar Tugas Harian',
        'kategori'  => 'JavaScript',
        'tahun'     => 2025,
        'deskripsi' => 'Aplikasi to-do list untuk mencatat, menandai, dan menghapus tugas harian.',
    ],
    [
        'judul'     => 'Katalog Buku Perpustakaan',
        'kategori'  => 'PHP',
        'tahun'     => 2024,
        'deskripsi' => 'Katalog buku dengan fitur pencarian judul menggunakan parameter GET.',
    ],
    [
        'judul'     => 'Desain Ulang Website Kampus',
        'kategori'  => 'Web',
        'tahun'     => 2024,
        'deskripsi' => 'Studi desain ulang halaman beranda kampus agar lebih mudah dipakai di ponsel.',
    ],
];

/** Mengamankan teks sebelum ditampilkan di HTML. */
function e(string $teks): string
{
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

/**
 * Memfilter proyek berdasarkan kata kunci (judul, kategori, atau deskripsi).
 * Jika kata kunci kosong, semua proyek dikembalikan.
 */
function cariProyek(array $data, string $kataKunci): array
{
    if ($kataKunci === '') {
        return $data;
    }
    $hasil = [];
    foreach ($data as $proyek) {
        $gabungan = $proyek['judul'] . ' ' . $proyek['kategori'] . ' ' . $proyek['deskripsi'];
        if (stripos($gabungan, $kataKunci) !== false) {
            $hasil[] = $proyek;
        }
    }
    return $hasil;
}

/** Mengambil sebagian data untuk satu halaman (pagination sederhana). */
function ambilHalaman(array $data, int $halaman, int $perHalaman): array
{
    return array_slice($data, ($halaman - 1) * $perHalaman, $perHalaman);
}

/** Menghasilkan HTML satu kartu proyek. */
function kartuProyek(array $proyek): string
{
    return '<article class="kartu">'
        . '<h3>' . e($proyek['judul']) . '</h3>'
        . '<p class="meta">' . e($proyek['kategori']) . ' &middot; ' . (int) $proyek['tahun'] . '</p>'
        . '<p>' . e($proyek['deskripsi']) . '</p>'
        . '</article>';
}
