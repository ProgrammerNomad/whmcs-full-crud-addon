<?php

use WHMCS\Database\Capsule;

class FullCRUD {

    public function createData($data) {
        $name = $data['name'];
        $value = $data['value'];
        Capsule::table('mod_fullcrud_data')->insert(
            ['name' => $name, 'value' => $value]
        );
    }

    public function readData() {
        return Capsule::table('mod_fullcrud_data')->get()->toArray();
    }

    public function updateData($data) {
        $id = $data['id'];
        $name = $data['name'];
        $value = $data['value'];
        Capsule::table('mod_fullcrud_data')
              ->where('id', $id)
              ->update(['name' => $name, 'value' => $value]);
    }

    public function deleteData($id) {
        Capsule::table('mod_fullcrud_data')->where('id', $id)->delete();
    }
}