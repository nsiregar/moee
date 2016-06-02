<?php

function get_machines() {
    return get_objects_by_sql("SELECT * FROM `machines`");
}

function get_machine_by_id($id) {
    $sql =
        "SELECT * " .
        "FROM machines " .
        "WHERE id=:id";
    return get_object_by_sql($sql, array(':id' => $id));
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

function update_machine_obj($machine_obj) {
    return update_object($machine_obj, 'machines', machine_columns());
}

function create_machine_obj($machine_obj) {
    return create_object($machine_obj, 'machines', machine_columns());
}

function delete_machine_obj($man_obj) {
    delete_object_by_id($man_obj->id, 'machines');
}

function delete_machine_by_id($machine_id) {
    delete_object_by_id($machine_id, 'machines');
}

function make_machine_obj($params, $obj = null) {
    return create_model_object($params, $obj);
}

function machine_columns() {
    return array('code', 'name');
}
