<?php

namespace TrigurPackage\Traits;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

trait ArrayMethodsTrait
{
    protected function _idToKey($array)
    {
        if (empty($array) || ! is_array($array)) {
            return $array;
        }

        $result = [];

        foreach ($array as $item) {
            $result[$item['id']] = $item;
        }

        return $result;
    }

    protected function _restructuringFieldsArray(&$fields)
    {
        $fieldsNames = array_keys($fields);
        $result      = [];

        foreach ($fields[$fieldsNames[0]] as $key => $value) {
            $result[$key] = [];

            foreach ($fieldsNames as $fieldName) {
                $result[$key][$fieldName] = $fields[$fieldName][$key];
            }
        }

        $fields = $result;
    }
}