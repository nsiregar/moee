<?php

# GET /job
function jobs_index() {
    set('jobs', get_jobs());
    return html('jobs/index.html.php');
}

# GET /jobs/:id
function jobs_view() {
    $job = get_job_or_404();
    set('job', $job);
    return html('jobs/view.html.php');
}

# GET /jobs/:id/edit
function jobs_edit() {
    $job = get_job_or_404();
    set('job', $job);
    return html('jobs/edit.html.php');
}

# PUT /jobs/:id
function jobs_update() {
    $job_data = job_data_from_form();
    $job = get_job_or_404();
    $job = make_job_obj($job_data, $job);

    update_job_obj($job);
    redirect('jobs');
}

# GET /jobs/new
function jobs_new() {
    $job_data = job_data_from_form();
    set('job', make_job_obj($job_data));
    return html('jobs/new.html.php');
}

# POST /jobs
function jobs_create() {
    $job_data = job_data_from_form();
    $job = make_job_obj($job_data);

    create_job_obj($job);
    redirect('jobs');
}

# DELETE /jobs/:id
function jobs_delete() {
    delete_job_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    redirect('jobs');
}

function get_job_or_404() {
    $job = get_job_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    if (is_null($job)) {
        halt(NOT_FOUND, "This job doesn't exist.");
    }
    return $job;
}

function job_data_from_form() {
    return isset($_POST['job']) && is_array($_POST['job']) ? $_POST['job'] : array();
}
