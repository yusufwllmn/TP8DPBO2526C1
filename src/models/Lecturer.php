<?php
require_once 'models/Model.php';

class Lecturer extends Model
{
    protected $table = 'lecturers';
    protected $fields = ['name', 'nidn', 'phone', 'join_date', 'email', 'department'];

    public function all()
    {
        $sql = "SELECT l.*,
                  (SELECT COUNT(*) FROM courses c WHERE c.lecturer_id = l.id) AS total_courses,
                  (SELECT COUNT(*) FROM publications p WHERE p.lecturer_id = l.id) AS total_publications
                FROM lecturers l
                ORDER BY l.name ASC";
        return $this->run($sql)->fetchAll();
    }
}
