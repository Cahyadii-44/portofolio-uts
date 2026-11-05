<?php
// kontak.php - memproses method POST: validasi, tampilkan hasil, simpan ke pesan.json.
require __DIR__ . '/includes/data.php';

$judulHalaman = 'Kontak';
$nama = $email = $pesan = '';
$galat = [];
$berhasil = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Ambil & bersihkan input
    $nama  = trim(is_string($_POST['nama'] ?? null) ? $_POST['nama'] : '');
    $email = trim(is_string($_POST['email'] ?? null) ? $_POST['email'] : '');
    $pesan = trim(is_string($_POST['pesan'] ?? null) ? $_POST['pesan'] : '');

    // 2. Validasi
    if (empty($nama)) {
        $galat['nama'] = 'Nama wajib diisi.';
    }
    if (empty($email)) {
        $galat['email'] = 'Email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $galat['email'] = 'Format email tidak valid. Contoh: nama@contoh.com';
    }
    if (empty($pesan)) {
        $galat['pesan'] = 'Pesan wajib diisi.';
    } elseif (mb_strlen($pesan) < 10) {
        $galat['pesan'] = 'Pesan minimal 10 karakter.';
    }

    // 3. Jika valid, simpan ke berkas JSON (nilai tambah)
    if (empty($galat)) {
        $berkas = __DIR__ . '/pesan.json';
        $isi = [];
        if (is_file($berkas)) {
            $isi = json_decode((string) file_get_contents($berkas), true) ?: [];
        }
        $isi[] = [
            'waktu' => date('Y-m-d H:i:s'),
            'nama'  => $nama,
            'email' => $email,
            'pesan' => $pesan,
        ];
        file_put_contents($berkas, json_encode($isi, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
        $berhasil = true;
    }
}

require __DIR__ . '/includes/header.php';
?>
<section class="konten">
    <h2>Hubungi Saya</h2>

    <?php if ($berhasil): ?>
        <div class="pesan pesan-sukses" role="status">
            <h3>Terima kasih, <?= e($nama) ?>!</h3>
            <p>Pesan Anda sudah diterima. Berikut ringkasannya:</p>
            <dl>
                <dt>Nama</dt><dd><?= e($nama) ?></dd>
                <dt>Email</dt><dd><?= e($email) ?></dd>
                <dt>Pesan</dt><dd><?= nl2br(e($pesan)) ?></dd>
            </dl>
        </div>
    <?php else: ?>
        <?php if (!empty($galat)): ?>
            <p class="pesan pesan-galat" role="alert">Formulir belum lengkap. Periksa kolom yang ditandai di bawah.</p>
        <?php endif; ?>

        <form class="form-kontak" action="kontak.php" method="post" novalidate>
            <div class="kolom">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?= e($nama) ?>">
                <?php if (isset($galat['nama'])): ?><span class="galat"><?= e($galat['nama']) ?></span><?php endif; ?>
            </div>
            <div class="kolom">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= e($email) ?>">
                <?php if (isset($galat['email'])): ?><span class="galat"><?= e($galat['email']) ?></span><?php endif; ?>
            </div>
            <div class="kolom">
                <label for="pesan">Pesan</label>
                <textarea id="pesan" name="pesan" rows="5"><?= e($pesan) ?></textarea>
                <?php if (isset($galat['pesan'])): ?><span class="galat"><?= e($galat['pesan']) ?></span><?php endif; ?>
            </div>
            <button type="submit">Kirim pesan</button>
        </form>
    <?php endif; ?>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
