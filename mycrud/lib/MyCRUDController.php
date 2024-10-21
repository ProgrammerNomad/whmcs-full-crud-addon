<?php

namespace WHMCS\Module\Addon\MyCRUD;

use WHMCS\Database\Capsule;

class MyCRUDController
{
    public function index($vars)
    {
        $data = Capsule::table('mod_mycrud_data')->get()->toArray();

        return array(
            'pagetitle' => 'My CRUD',
            'breadcrumb' => array(
                'index.php?m=mycrud' => 'My CRUD',
            ),
            'templatefile' => 'mycrud',
            'requirelogin' => true,
            'vars' => array(
                'data' => $data,
            ),
        );
    }

    public function create($vars)
    {
        // Handle create action here
    }

    public function update($vars)
    {
        // Handle update action here
    }

    public function delete($vars)
    {
        // Handle delete action here
    }
}