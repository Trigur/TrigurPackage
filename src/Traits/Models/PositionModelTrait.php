<?php

namespace TrigurPackage\Traits\Models;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

trait PositionModelTrait
{
    public function changePosition($id, $position)
    {
        $this->update($id, ['position' => $position]);
    }

    public function changePositions($positions)
    {
        foreach ($positions as $position => $id) {
            $this->changePosition($id, $position);
        }
    }

    public function addLastPosition(&$data)
    {
        $data['position'] = $this->getPositionAfterLast();
    }

    public function getPositionAfterLast()
    {
        $this->db->select('MAX(position) as max');
        $queryResult = $this->db->get(self::$table)->row_array();

        return $queryResult ? $queryResult['max'] + 1 : 0;
    }

    public function getAllSortedByPosition($sortType = 'asc')
    {
        $this->db->order_by('position', $sortType);
        $this->db->order_by('id', $sortType);
        $queryResult = $this->db->get(self::$table)->result_array();

        return $queryResult;
    }
}