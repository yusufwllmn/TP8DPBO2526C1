<div class="row g-4">
  <div class="col-lg-8">
    <div class="panel">
      <div class="panel-head">Daftar publikasi (<?= count($items) ?>)</div>
      <?php if (!$items): ?>
        <div class="empty">Belum ada publikasi. Isi formulir di sebelah kanan untuk menambahkan.</div>
      <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr><th>Judul</th><th>Tahun</th><th>Penulis</th><th></th></tr>
          </thead>
          <tbody>
            <?php foreach ($items as $r): ?>
            <tr class="<?= ($edit['id'] ?? 0) == $r['id'] ? 'row-editing' : '' ?>">
              <td>
                <?= e($r['title']) ?>
                <span class="sub"><?= e($r['journal_name']) ?></span>
              </td>
              <td><?= e($r['publish_year']) ?></td>
              <td><?= e($r['lecturer_name']) ?></td>
              <td class="actions">
                <a class="btn btn-sm btn-outline-secondary" href="index.php?page=publications&edit=<?= $r['id'] ?>">Ubah</a>
                <form method="post" action="index.php?page=publications&action=delete"
                      onsubmit="return confirm('Hapus publikasi ini?')">
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
      <div class="panel-head <?= $edit ? 'editing' : '' ?>"><?= $edit ? 'Ubah publikasi' : 'Tambah publikasi' ?></div>
      <form class="panel-body" method="post" action="index.php?page=publications&action=<?= $edit ? 'update' : 'store' ?>">
        <?php if ($edit): ?><input type="hidden" name="id" value="<?= $edit['id'] ?>"><?php endif; ?>

        <div class="mb-3">
          <label class="form-label" for="title">Judul</label>
          <textarea class="form-control" id="title" name="title" rows="3" required><?= e($form['title'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label" for="journal_name">Nama jurnal</label>
          <input class="form-control" id="journal_name" name="journal_name" value="<?= e($form['journal_name'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="publish_year">Tahun terbit</label>
          <input class="form-control" type="number" min="1990" max="2100" id="publish_year" name="publish_year" value="<?= e($form['publish_year'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="lecturer_id">Penulis (dosen)</label>
          <select class="form-select" id="lecturer_id" name="lecturer_id" required>
            <option value="">Pilih dosen</option>
            <?php foreach ($lecturers as $l): ?>
              <option value="<?= $l['id'] ?>" <?= ($form['lecturer_id'] ?? '') == $l['id'] ? 'selected' : '' ?>><?= e($l['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <button class="btn btn-primary"><?= $edit ? 'Simpan perubahan' : 'Tambah publikasi' ?></button>
        <?php if ($edit): ?><a class="btn btn-link" href="index.php?page=publications">Batal</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>
