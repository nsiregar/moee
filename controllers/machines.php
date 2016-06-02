<?php

# GET /machine
function machines_index() {
    set('machines', get_machines());
    return html('machines/index.html.php');
}

# GET /machines/:id
function machines_view() {
    $machine = get_machine_or_404();
    set('machine', $machine);
    return html('machines/view.html.php');
}

# GET /machines/:id/edit
function machines_edit() {
    $machine = get_machine_or_404();
    set('machine', $machine);
    return html('machines/edit.html.php');
}

# PUT /machines/:id
function machines_update() {
    $machine_data = machine_data_from_form();
    $machine = get_machine_or_404();
    $machine = make_machine_obj($machine_data, $machine);

    update_machine_obj($machine);
    redirect('machines');
}

# GET /machines/new
function machines_new() {
    $machine_data = machine_data_from_form();
    set('machine', make_machine_obj($machine_data));
    return html('machines/new.html.php');
}

# POST /machines
function machines_create() {
    $machine_data = machine_data_from_form();
    $machine = make_machine_obj($machine_data);

    create_machine_obj($machine);
    redirect('machines');
}

# DELETE /machines/:id
function machines_delete() {
    delete_machine_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    redirect('machines');
}

function get_machine_or_404() {
    $machine = get_machine_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    if (is_null($machine)) {
        halt(NOT_FOUND, "This machine doesn't exist.");
    }
    return $machine;
}

function machine_data_from_form() {
    return isset($_POST['machine']) && is_array($_POST['machine']) ? $_POST['machine'] : array();
}
