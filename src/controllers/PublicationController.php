<?php
require_once 'controllers/Controller.php';
require_once 'models/Publication.php';
require_once 'models/Lecturer.php';
class PublicationController extends Controller
{
    protected $page = 'publications';
    protected $label = 'publikasi';

    public function __construct($db)
    {
        parent::__construct($db);
        $this->model = new Publication($db);
    }

    protected function extra()
    {
        return ['lecturers' => (new Lecturer($this->db))->all()];
    }
}
