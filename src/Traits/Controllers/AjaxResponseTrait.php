<?php

trait AjaxResponseTrait
{
    protected function _ajaxResponse($status = null, $message = null, $data = null)
    {
        $responseData = [];

        if ($status) {
            $responseData['status'] = $status;
        }

        if ($message) {
            $responseData['message'] = $message;
        }

        if ($data) {
            $responseData = array_merge($responseData, $data);
        }

        exit(json_encode($responseData));
    }
}