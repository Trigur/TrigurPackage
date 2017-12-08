<?php

namespace TrigurPackage\Models;

abstract class AbstractBaseModel extends \CI_Model {
    protected static $table;

    public static function getTableName()
    {
        return static::$table;
    }

    public function all()
    {
        $this->db->get(static::$table);

        return $this->db->get(static::$table)->result_array();
    }

    public function get($id)
    {
        return $this->getRowBy('id', $id);
    }

    public function getRowBy($field, $value)
    {
        $this->db->where($field, $value);
        return $this->db->get(static::$table)->row_array();
    }

    public function getAllBy($field, $value)
    {
        $this->db->where($field, $value);
        return $this->db->get(static::$table)->result_array();
    }

    public function create($data)
    {
        $this->db->insert(static::$table, $data);

        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update(static::$table, $data);
    }

    public function remove($id)
    {
        $this->removeBy('id', $id);
    }

    public function removeBy($field, $value)
    {
        $this->db->where($field, $value);
        $this->db->delete(static::$table);
    }
}
