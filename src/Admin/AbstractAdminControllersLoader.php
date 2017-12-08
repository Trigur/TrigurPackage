<?php

namespace TrigurPackage\Admin;

(defined('BASEPATH')) OR exit('No direct script access allowed');

abstract class AbstractAdminControllersLoader extends \BaseAdminController
{
    protected static $moduleName;
    protected static $basePath;

    public function __construct()
    {
        parent::__construct();

        $controllerNameSegment = $this->uri->segment(5);

        if (! $controllerNameSegment) {
            redirect(static::$basePath);
        }

        $moduleName = $this->toCamelCase(static::$moduleName);

        $className = $moduleName . 'Admin' . ucfirst($controllerNameSegment) . 'Controller';
        $classFile = __DIR__ . '/admin/' . $className . '.php';

        if (! file_exists($classFile)) {
            redirect(static::$basePath);
        }

        if (! ($methodName = $this->uri->segment(6))) {
            $methodName = 'index';
        }

        require $classFile;

        $controller = new $className;

        if (method_exists($controller, $methodName)) {
            $arguments = $this->core->grab_variables(7);

            call_user_func_array(array($controller, $methodName), $arguments);
        }
    }

    protected function toCamelCase($string)
    {
        $string = str_replace('_', ' ', $string);
        $string = ucwords($string);
        $string = str_replace(' ', '', $string);
        return $string;
    }
}
