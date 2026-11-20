<?php
require_once 'controllers/Controller.php';
require_once 'models/Lecturer.php';

class LecturerController extends Controller
{
    protected $page = 'lecturers';
    protected $label = 'dosen';

    public function __construct($db)
    {
        parent::__construct($db);
        $this->model = new Lecturer($db);
    }
}
