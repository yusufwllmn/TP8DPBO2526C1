<div class="row g-4">
  <div class="col-lg-8">
    <div class="panel">
      <div class="panel-head">Daftar mata kuliah (<?= count($items) ?>)</div>
      <?php if (!$items): ?>
        <div class="empty">Belum ada mata kuliah. Isi formulir di sebelah kanan untuk menambahkan.</div>
      <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr><th>Kode</th><th>Mata kuliah</th><th>SKS</th><th>Dosen pengampu</th><th></th></tr>
          </thead>
          <tbody>
            <?php foreach ($items as $r): ?>
            <tr class="<?= ($edit['id'] ?? 0) == $r['id'] ? 'row-editing' : '' ?>">
              <td><?= e($r['course_code']) ?></td>
              <td><?= e($r['course_name']) ?></td>
              <td><?= (int) $r['credits'] ?></td>
              <td><?= e($r['lecturer_name']) ?></td>
              <td class="actions">
                <a class="btn btn-sm btn-outline-secondary" href="index.php?page=courses&edit=<?= $r['id'] ?>">Ubah</a>
                <form method="post" action="index.php?page=courses&action=delete"
                      onsubmit="return confirm('Hapus mata kuliah <?= e($r['course_name']) ?>?')">
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
      <div class="panel-head <?= $edit ? 'editing' : '' ?>"><?= $edit ? 'Ubah mata kuliah' : 'Tambah mata kuliah' ?></div>
      <form class="panel-body" method="post" action="index.php?page=courses&action=<?= $edit ? 'update' : 'store' ?>">
        <?php if ($edit): ?><input type="hidden" name="id" value="<?= $edit['id'] ?>"><?php endif; ?>

        <div class="mb-3">
          <label class="form-label" for="course_code">Kode</label>
          <input class="form-control" id="course_code" name="course_code" value="<?= e($form['course_code'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="course_name">Nama mata kuliah</label>
          <input class="form-control" id="course_name" name="course_name" value="<?= e($form['course_name'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="credits">SKS</label>
          <input class="form-control" type="number" min="1" max="6" id="credits" name="credits" value="<?= e($form['credits'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="lecturer_id">Dosen pengampu</label>
          <select class="form-select" id="lecturer_id" name="lecturer_id" required>
            <option value="">Pilih dosen</option>
            <?php foreach ($lecturers as $l): ?>
              <option value="<?= $l['id'] ?>" <?= ($form['lecturer_id'] ?? '') == $l['id'] ? 'selected' : '' ?>><?= e($l['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <button class="btn btn-primary"><?= $edit ? 'Simpan perubahan' : 'Tambah mata kuliah' ?></button>
        <?php if ($edit): ?><a class="btn btn-link" href="index.php?page=courses">Batal</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>
