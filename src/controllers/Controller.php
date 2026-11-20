<?php
abstract class Controller
{
    protected $db;
    protected $model;
    protected $page;    // nama route sekaligus nama folder view
    protected $label;   // dipakai di pesan, mis. "dosen"

    public function __construct($db)
    {
        $this->db = $db;
    }

    // data tambahan untuk view (mis. daftar dosen untuk dropdown)
    protected function extra()
    {
        return [];
    }

    public function index()
    {
        $items = $this->model->all();
        $edit = isset($_GET['edit']) ? $this->model->find((int) $_GET['edit']) : null;
        $form = $_SESSION['old'] ?? $edit ?? [];
        unset($_SESSION['old']);

        $vars = array_merge($this->extra(), [
            'items' => $items,
            'edit'  => $edit,
            'form'  => $form,
            'page'  => $this->page,
        ]);
        extract($vars);

        require 'views/layout/header.php';
        require "views/{$this->page}/index.php";
        require 'views/layout/footer.php';
    }

    public function store()
    {
        $this->save(null);
    }

    public function update()
    {
        $this->save((int) ($_POST['id'] ?? 0));
    }

    public function delete()
    {
        try {
            $this->model->delete((int) ($_POST['id'] ?? 0));
            flash('success', "Data {$this->label} dihapus.");
        } catch (PDOException $e) {
            flash('danger', "Data {$this->label} gagal dihapus.");
        }
        redirect($this->page);
    }

    private function save($id)
    {
        $data = [];
        foreach ($this->model->fields() as $f) {
            $data[$f] = trim($_POST[$f] ?? '');
        }
        $back = $id ? "&edit=$id" : '';

        if (in_array('', $data, true)) {
            $_SESSION['old'] = $data;
            flash('danger', 'Semua kolom harus diisi.');
            redirect($this->page, $back);
        }

        try {
            if ($id) {
                $this->model->update($id, $data);
                flash('success', "Data {$this->label} diperbarui.");
            } else {
                $this->model->create($data);
                flash('success', "Data {$this->label} ditambahkan.");
            }
        } catch (PDOException $e) {
            $_SESSION['old'] = $data;
            $msg = 'Data gagal disimpan.';
            if (($e->errorInfo[1] ?? 0) == 1062) $msg = 'NIDN sudah dipakai dosen lain.';
            if (($e->errorInfo[1] ?? 0) == 1452) $msg = 'Dosen yang dipilih tidak ditemukan.';
            flash('danger', $msg);
            redirect($this->page, $back);
        }
        redirect($this->page);
    }
}
