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
                'action' => 'index', // Add an action variable
            ),
        );
    }

    public function create($vars)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission
            $name = $_POST['name'];
            $value = $_POST['value'];
            Capsule::table('mod_mycrud_data')->insert(
                ['name' => $name, 'value' => $value]
            );

            // Redirect to index after creating
            header("Location: addonmodules.php?module=mycrud");
            exit;
        }

        return array(
            'pagetitle' => 'My CRUD - Create',
            'breadcrumb' => array(
                'index.php?m=mycrud' => 'My CRUD',
                'index.php?m=mycrud&action=create' => 'Create',
            ),
            'templatefile' => 'mycrud',
            'requirelogin' => true,
            'vars' => array(
                'action' => 'create',
            ),
        );
    }

    public function update($vars)
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
        $data = Capsule::table('mod_mycrud_data')->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission
            $name = $_POST['name'];
            $value = $_POST['value'];
            Capsule::table('mod_mycrud_data')
                  ->where('id', $id)
                  ->update(['name' => $name, 'value' => $value]);

            // Redirect to index after updating
            header("Location: addonmodules.php?module=mycrud");
            exit;
        }

        return array(
            'pagetitle' => 'My CRUD - Update',
            'breadcrumb' => array(
                'index.php?m=mycrud' => 'My CRUD',
                'index.php?m=mycrud&action=update&id=' . $id => 'Update',
            ),
            'templatefile' => 'mycrud',
            'requirelogin' => true,
            'vars' => array(
                'action' => 'update',
                'data' => $data,
            ),
        );
    }

    public function delete($vars)
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
        Capsule::table('mod_mycrud_data')->where('id', $id)->delete();

        // Redirect to index after deleting
        header("Location: addonmodules.php?module=mycrud");
        exit;
    }
}