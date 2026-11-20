<?php
require_once 'models/Model.php';

class Course extends Model
{
    protected $table = 'courses';
    protected $fields = ['lecturer_id', 'course_code', 'course_name', 'credits'];

    public function all()
    {
        $sql = "SELECT c.*, l.name AS lecturer_name
                FROM courses c
                JOIN lecturers l ON l.id = c.lecturer_id
                ORDER BY c.course_code ASC";
        return $this->run($sql)->fetchAll();
    }
}
