<?php

function get_users() {
    return get_objects_by_sql("SELECT * FROM `users`");
}

function get_user_by_id($id) {
    $sql =
        "SELECT * " .
        "FROM users " .
        "WHERE id=:id";
    return get_object_by_sql($sql, array(':id' => $id));
}

function get_user_auth($username, $password) {
    $sql =
        "SELECT * " .
        "FROM users " .
        "WHERE username=:username AND password=:password";
    return get_object_by_sql($sql, array(':username' => $username, ':password' => $password));
}

function get_user_mail($email) {
    $sql =
        "SELECT * " .
        "FROM users " .
        "WHERE email=:email";
    return get_object_by_sql($sql, array(':email' => $email));
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

function update_user_obj($user_obj) {
    return update_object($user_obj, 'users', user_columns());
}

function create_user_obj($user_obj) {
    return create_object($user_obj, 'users', user_columns());
}

function delete_user_obj($man_obj) {
    delete_object_by_id($man_obj->id, 'users');
}

function delete_user_by_id($user_id) {
    delete_object_by_id($user_id, 'users');
}

function make_user_obj($params, $obj = null) {
    return create_model_object($params, $obj);
}

function user_columns() {
    return array('name', 'username', 'password', 'email', 'isadministrator', 'createddate');
}
