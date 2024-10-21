<?php

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function full_crud_config() {
    $configarray = array(
        "name" => "Full CRUD",
        "description" => "My custom WHMCS addon with full CRUD operations.",
        "version" => "1.0",
        "author" => "Shiv Singh",
        "language" => "english",
        "fields" => array()
    );
    return $configarray;
}

function full_crud_activate() {
    try {
        if (!Capsule::schema()->hasTable('mod_fullcrud_data')) {
            Capsule::schema()->create('mod_fullcrud_data', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->text('value');
            });

            if (!Capsule::table('mod_fullcrud_data')->count()) {
                Capsule::table('mod_fullcrud_data')->insert([
                    ['name' => 'Initial Data 1', 'value' => 'Value 1'],
                    ['name' => 'Initial Data 2', 'value' => 'Value 2']
                ]);
            }
        }

        return array('status'=>'success','description'=>'Full CRUD activated successfully.');
    } catch (Exception $e) {
        return array('status'=>'error','description'=>'Error activating Full CRUD: ' . $e->getMessage());
    }
}

function full_crud_deactivate() {
    if (isset($_POST['drop_table']) && $_POST['drop_table'] == '1') {
        try {
            Capsule::schema()->dropIfExists('mod_fullcrud_data');

            return array('status'=>'success','description'=>'Full CRUD deactivated and table dropped successfully.');
        } catch (Exception $e) {
            return array('status'=>'error','description'=>'Error dropping table: ' . $e->getMessage());
        }
    } else {
        return array('status'=>'success','description'=>'Full CRUD deactivated successfully. Table was not dropped.');
    }
}

function full_crud_output($vars) {
    require_once __DIR__ . '/lib/FullCRUD.php';
    $fullCRUD = new FullCRUD();

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

    switch ($action) {
        case 'create':
            $fullCRUD->createData($_POST);
            break;
        case 'read':
            $data = $fullCRUD->readData();
            break;
        case 'update':
            $fullCRUD->updateData($_POST);
            break;
        case 'delete':
            $fullCRUD->deleteData($_POST['id']);
            break;
        default:
            $data = $fullCRUD->readData();
            break;
    }

    $templatevars = array(
        'data' => $data,
        'action' => $action,
        'WEB_ROOT' => $vars['WEB_ROOT']
    );

    return array(
        'templatefile' => 'admin/full_crud',
        'vars' => $templatevars
    );
}