<?php

class ErrorController extends Zend_Controller_Action
{

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        echo "<pre>";
        var_dump($errors->exception);
        echo "</pre>";
    }
}