<?php
require_once 'controllers/Controller.php';
require_once 'models/Course.php';
require_once 'models/Lecturer.php';
class CourseController extends Controller
{
    protected $page = 'courses';
    protected $label = 'mata kuliah';

    public function __construct($db)
    {
        parent::__construct($db);
        $this->model = new Course($db);
    }

    protected function extra()
    {
        return ['lecturers' => (new Lecturer($this->db))->all()];
    }
}
