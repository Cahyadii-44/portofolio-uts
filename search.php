<?php
// search.php - memproses method GET: mencari proyek berdasarkan kata kunci.
require __DIR__ . '/includes/data.php';

$judulHalaman = 'Cari Proyek';
$perHalaman   = 3;

// Ambil dan bersihkan input dari $_GET
$kataKunci = (isset($_GET['q']) && is_string($_GET['q'])) ? trim($_GET['q']) : '';
$halaman   = isset($_GET['hal']) ? (int) $_GET['hal'] : 1;
if ($halaman < 1) {
    $halaman = 1;
}

$hasil        = cariProyek($daftarProyek, $kataKunci);
$totalHasil   = count($hasil);
$totalHalaman = max(1, (int) ceil($totalHasil / $perHalaman));
if ($halaman > $totalHalaman) {
    $halaman = $totalHalaman;
}
$tampil = ambilHalaman($hasil, $halaman, $perHalaman);

require __DIR__ . '/includes/header.php';
?>
<section class="konten">
    <h2>Cari Proyek</h2>
    <form class="form-cari" action="search.php" method="get">
        <label for="q">Kata kunci</label>
        <input type="search" id="q" name="q" value="<?= e($kataKunci) ?>" placeholder="Contoh: PHP, web, katalog">
        <button type="submit">Cari</button>
    </form>

    <?php if ($kataKunci === ''): ?>
        <p class="info">Menampilkan semua proyek (<?= $totalHasil ?>). Ketik kata kunci untuk menyaring.</p>
    <?php elseif ($totalHasil === 0): ?>
        <p class="pesan pesan-kosong" role="status">
            Tidak ada proyek yang cocok dengan &ldquo;<?= e($kataKunci) ?>&rdquo;.
            Coba kata kunci lain, misalnya &ldquo;PHP&rdquo; atau &ldquo;web&rdquo;.
        </p>
    <?php else: ?>
        <p class="info">Ditemukan <?= $totalHasil ?> proyek untuk &ldquo;<?= e($kataKunci) ?>&rdquo;.</p>
    <?php endif; ?>

    <div class="daftar-kartu">
        <?php foreach ($tampil as $proyek): ?>
            <?= kartuProyek($proyek) ?>
        <?php endforeach; ?>
    </div>

    <?php if ($totalHalaman > 1): ?>
        <nav class="pagination" aria-label="Halaman hasil pencarian">
            <?php for ($i = 1; $i <= $totalHalaman; $i++): ?>
                <?php $tautan = 'search.php?q=' . urlencode($kataKunci) . '&hal=' . $i; ?>
                <?php if ($i === $halaman): ?>
                    <span class="aktif" aria-current="page"><?= $i ?></span>
                <?php else: ?>
                    <a href="<?= e($tautan) ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </nav>
    <?php endif; ?>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
