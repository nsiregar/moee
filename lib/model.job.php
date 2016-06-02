<?php

function get_jobs() {
    return get_objects_by_sql("SELECT * FROM `jobs`");
}

function get_job_by_id($id) {
    $sql =
        "SELECT * " .
        "FROM jobs " .
        "WHERE id=:id";
    return get_object_by_sql($sql, array(':id' => $id));
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

function update_job_obj($job_obj) {
    return update_object($job_obj, 'jobs', job_columns());
}

function create_job_obj($job_obj) {
    return create_object($job_obj, 'jobs', job_columns());
}

function delete_job_obj($man_obj) {
    delete_object_by_id($man_obj->id, 'jobs');
}

function delete_job_by_id($job_id) {
    delete_object_by_id($job_id, 'jobs');
}

function make_job_obj($params, $obj = null) {
    return create_model_object($params, $obj);
}

function job_columns() {
    return array('jn', 'name', 'wo', 'unit', 'model', 'stamp');
}
