<div class="row g-4">
  <div class="col-lg-8">
    <div class="panel">
      <div class="panel-head">Daftar dosen (<?= count($items) ?>)</div>
      <?php if (!$items): ?>
        <div class="empty">Belum ada data dosen. Isi formulir di sebelah kanan untuk menambahkan.</div>
      <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr><th>Nama</th><th>NIDN</th><th>Bergabung</th><th>MK</th><th>Publikasi</th><th></th></tr>
          </thead>
          <tbody>
            <?php foreach ($items as $r): ?>
            <tr class="<?= ($edit['id'] ?? 0) == $r['id'] ? 'row-editing' : '' ?>">
              <td>
                <?= e($r['name']) ?>
                <span class="sub"><?= e($r['department']) ?></span>
                <span class="sub"><?= e($r['email']) ?> / <?= e($r['phone']) ?></span>
              </td>
              <td><?= e($r['nidn']) ?></td>
              <td><?= e(date('d-m-Y', strtotime($r['join_date']))) ?></td>
              <td><?= (int) $r['total_courses'] ?></td>
              <td><?= (int) $r['total_publications'] ?></td>
              <td class="actions">
                <a class="btn btn-sm btn-outline-secondary" href="index.php?page=lecturers&edit=<?= $r['id'] ?>">Ubah</a>
                <form method="post" action="index.php?page=lecturers&action=delete"
                      onsubmit="return confirm('Hapus <?= e($r['name']) ?>? Mata kuliah dan publikasinya ikut terhapus.')">
                  <input type="hidden" name="id" value="<?= $r['id'] ?>">
                  <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="panel form-side">
      <div class="panel-head <?= $edit ? 'editing' : '' ?>"><?= $edit ? 'Ubah data dosen' : 'Tambah dosen' ?></div>
      <form class="panel-body" method="post" action="index.php?page=lecturers&action=<?= $edit ? 'update' : 'store' ?>">
        <?php if ($edit): ?><input type="hidden" name="id" value="<?= $edit['id'] ?>"><?php endif; ?>

        <div class="mb-3">
          <label class="form-label" for="name">Nama lengkap</label>
          <input class="form-control" id="name" name="name" value="<?= e($form['name'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="nidn">NIDN</label>
          <input class="form-control" id="nidn" name="nidn" value="<?= e($form['nidn'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="email">Email</label>
          <input class="form-control" type="email" id="email" name="email" value="<?= e($form['email'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="phone">No. telepon</label>
          <input class="form-control" id="phone" name="phone" value="<?= e($form['phone'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="department">Program studi</label>
          <?php $dep = $form['department'] ?? ''; ?>
          <select class="form-select" id="department" name="department" required>
            <option value="">Pilih program studi</option>
            <?php foreach (['Ilmu Komputer', 'Pendidikan Ilmu Komputer'] as $d): ?>
              <option <?= $dep === $d ? 'selected' : '' ?>><?= e($d) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="join_date">Tanggal bergabung</label>
          <input class="form-control" type="date" id="join_date" name="join_date" value="<?= e($form['join_date'] ?? '') ?>" required>
        </div>

        <button class="btn btn-primary"><?= $edit ? 'Simpan perubahan' : 'Tambah dosen' ?></button>
        <?php if ($edit): ?><a class="btn btn-link" href="index.php?page=lecturers">Batal</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>
