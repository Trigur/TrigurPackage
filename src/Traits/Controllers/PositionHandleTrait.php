<?php

namespace TrigurPackage\Traits\Controllers;

trait PositionHandleTrait
{
    public function savePositions()
    {
        $positions = $this->input->post('positions');

        if (empty($positions) || !is_array($positions)) {
            return;
        }

        $this->_getControllerBaseModel()->changePositions($positions);

        showMessage(lang('The position has been successfully saved', 'admin'));
    }
}
