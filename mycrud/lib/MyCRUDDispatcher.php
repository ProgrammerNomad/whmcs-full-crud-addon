<?php

namespace WHMCS\Module\Addon\MyCRUD;

class MyCRUDDispatcher
{
    public function dispatch($action, $vars)
    {
        $controller = new MyCRUDController();

        if (method_exists($controller, $action)) {
            return $controller->{$action}($vars);
        } else {
            return $controller->index($vars);
        }
    }
}