<?php

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function mycrud_config() {
    $configarray = array(
        "name" => "My CRUD",
        "description" => "My custom WHMCS addon with full CRUD operations.",
        "version" => "1.0",
        "author" => "Shiv Singh",
        "language" => "english",
        "fields" => array()
    );
    return $configarray;
}

function mycrud_activate() {
    try {
        if (!Capsule::schema()->hasTable('mod_mycrud_data')) { // Updated table name
            Capsule::schema()->create('mod_mycrud_data', function ($table) { // Updated table name
                $table->increments('id');
                $table->string('name');
                $table->text('value');
            });

            if (!Capsule::table('mod_mycrud_data')->count()) { // Updated table name
                Capsule::table('mod_mycrud_data')->insert([ // Updated table name
                    ['name' => 'Initial Data 1', 'value' => 'Value 1'],
                    ['name' => 'Initial Data 2', 'value' => 'Value 2']
                ]);
            }
        }

        return array('status'=>'success','description'=>'My CRUD activated successfully.');
    } catch (Exception $e) {
        return array('status'=>'error','description'=>'Error activating My CRUD: ' . $e->getMessage());
    }
}

function mycrud_deactivate() {
    if (isset($_POST['drop_table']) && $_POST['drop_table'] == '1') {
        try {
            Capsule::schema()->dropIfExists('mod_mycrud_data'); // Updated table name

            return array('status'=>'success','description'=>'My CRUD deactivated and table dropped successfully.');
        } catch (Exception $e) {
            return array('status'=>'error','description'=>'Error dropping table: ' . $e->getMessage());
        }
    } else {
        return array('status'=>'success','description'=>'My CRUD deactivated successfully. Table was not dropped.');
    }
}

function mycrud_output($vars) {
    require_once __DIR__ . '/lib/FullCRUD.php'; // Assuming the class name is still FullCRUD
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
        'templatefile' => 'admin/mycrud', 
        'vars' => $templatevars
    );
}