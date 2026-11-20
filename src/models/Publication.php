<?php
require_once 'models/Model.php';

class Publication extends Model
{
    protected $table = 'publications';
    protected $fields = ['lecturer_id', 'title', 'journal_name', 'publish_year'];

    public function all()
    {
        $sql = "SELECT p.*, l.name AS lecturer_name
                FROM publications p
                JOIN lecturers l ON l.id = p.lecturer_id
                ORDER BY p.publish_year DESC, p.id DESC";
        return $this->run($sql)->fetchAll();
    }
}
