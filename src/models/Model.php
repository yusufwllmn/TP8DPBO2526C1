<?php
abstract class Model
{
    protected $db;
    protected $table;
    protected $fields = [];

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function fields()
    {
        return $this->fields;
    }

    protected function run($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function all()
    {
        return $this->run("SELECT * FROM {$this->table} ORDER BY id DESC")->fetchAll();
    }

    public function find($id)
    {
        $row = $this->run("SELECT * FROM {$this->table} WHERE id = ?", [$id])->fetch();
        return $row ?: null;
    }

    public function create($data)
    {
        $cols = implode(', ', $this->fields);
        $marks = implode(', ', array_fill(0, count($this->fields), '?'));
        $this->run("INSERT INTO {$this->table} ($cols) VALUES ($marks)", $this->values($data));
    }

    public function update($id, $data)
    {
        $set = implode(', ', array_map(function ($f) { return "$f = ?"; }, $this->fields));
        $params = $this->values($data);
        $params[] = $id;
        $this->run("UPDATE {$this->table} SET $set WHERE id = ?", $params);
    }

    public function delete($id)
    {
        $this->run("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    private function values($data)
    {
        return array_map(function ($f) use ($data) { return $data[$f]; }, $this->fields);
    }
}
