<?php

use WHMCS\Database\Capsule;

class FullCRUD {

    public function createData($data) {
        $name = $data['name'];
        $value = $data['value'];
        Capsule::table('mod_mycrud_data')->insert( // Updated table name
            ['name' => $name, 'value' => $value]
        );
    }

    public function readData() {
        return Capsule::table('mod_mycrud_data')->get()->toArray(); // Updated table name
    }

    public function updateData($data) {
        $id = $data['id'];
        $name = $data['name'];
        $value = $data['value'];
        Capsule::table('mod_mycrud_data') // Updated table name
              ->where('id', $id)
              ->update(['name' => $name, 'value' => $value]);
    }

    public function deleteData($id) {
        Capsule::table('mod_mycrud_data')->where('id', $id)->delete(); // Updated table name
    }
}