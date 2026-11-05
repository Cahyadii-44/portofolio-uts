<?php
// Template header + navigasi. Variabel $judulHalaman diisi oleh halaman pemanggil.
$judulHalaman = $judulHalaman ?? 'Beranda';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($judulHalaman, ENT_QUOTES, 'UTF-8') ?> | Portofolio Cahyadi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="situs-header">
    <h1 class="judul-situs">Portofolio Cahyadi</h1>
    <nav aria-label="Navigasi utama">
        <ul class="menu">
            <li><a href="index.html">Beranda</a></li>
            <li><a href="search.php">Cari Proyek</a></li>
            <li><a href="kontak.php">Kontak</a></li>
            <li><a href="https://www.linkedin.com/in/cahyadi-cahyadi-20150a449" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
        </ul>
    </nav>
</header>
<main class="halaman">
