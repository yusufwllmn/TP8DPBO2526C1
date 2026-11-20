<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Dosen Ilmu Komputer</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark topbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">Dosen Ilmu Komputer</a>
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link <?= $page === 'lecturers' ? 'active' : '' ?>" href="index.php?page=lecturers">Dosen</a></li>
        <li class="nav-item"><a class="nav-link <?= $page === 'courses' ? 'active' : '' ?>" href="index.php?page=courses">Mata kuliah</a></li>
        <li class="nav-item"><a class="nav-link <?= $page === 'publications' ? 'active' : '' ?>" href="index.php?page=publications">Publikasi</a></li>
      </ul>
    </div>
  </nav>

  <main class="container my-4">
    <?php if ($f = flash()): ?>
      <div class="alert alert-<?= e($f['type']) ?> py-2" role="alert"><?= e($f['msg']) ?></div>
    <?php endif; ?>
