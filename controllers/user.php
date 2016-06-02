<?php

# GET /user
function users_index() {
    set('users', get_users());
    return html('users/index.html.php');
}

# GET /users/:id
function users_view() {
    $user = get_user_or_404();
    set('user', $user);
    return html('users/view.html.php');
}

# GET /users/:id/edit
function users_edit() {
    $user = get_user_or_404();
    set('user', $user);
    return html('users/edit.html.php');
}

# PUT /users/:id
function users_update() {
    $user_data = user_data_from_form();
    $user = get_user_or_404();
    $user = make_user_obj($user_data, $user);

    update_user_obj($user);
    redirect('users');
}

# GET /users/new
function users_new() {
    $user_data = user_data_from_form();
    set('user', make_user_obj($user_data));
    return html('users/new.html.php');
}

# POST /users
function users_create() {
    $user_data = user_data_from_form();
    $user = make_user_obj($user_data);

    create_user_obj($user);
    redirect('users');
}

# DELETE /users/:id
function users_delete() {
    delete_user_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    redirect('users');
}

function get_user_or_404() {
    $user = get_user_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    if (is_null($user)) {
        halt(NOT_FOUND, "This user doesn't exist.");
    }
    return $user;
}

function user_data_from_form() {
    return isset($_POST['user']) && is_array($_POST['user']) ? $_POST['user'] : array();
}
