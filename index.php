<?php

require_once('lib/limonade.php');
require('./config.php');

function configure() {
    $env = $_SERVER['HTTP_HOST'] == 'moee' ? ENV_DEVELOPMENT : ENV_PRODUCTION;
    $dsn = $env == ENV_PRODUCTION ? 'mysql:host=10.169.9.11;dbname=machine_oee;charset=utf8mb4' : 'mysql:host=10.169.9.11;dbname=dev_oee;charset=utf8mb4';
    $db = new PDO($dsn,'root', 'root');
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    option('env', $env);
    option('dsn', $dsn);
    option('db_conn', $db);
    option('debug', true);
    option('base_uri', '/moee/');
}

function after($output) {
    $time = number_format( (float)substr(microtime(), 0, 10) - LIM_START_MICROTIME, 6);
    $output .= "<!-- page rendered in $time sec., on " . date(DATE_RFC822)."-->";
    return $output;
}

layout('layout/default.html.php');

// main controller
dispatch('/', 'main_page');

// auth controller
dispatch        ('login',               'login');
dispatch_post   ('login',               'login_post');
dispatch        ('login/reset',         'login_reset');
dispatch_post   ('login/reset',         'login_reset_post');
dispatch        ('logout',              'logout');

// machine controller
dispatch_get    ('machines',            'machines_index');
dispatch_post   ('machines',            'machines_create');
dispatch_get    ('machines/new',        'machines_new');
dispatch_get    ('machines/:id/edit',   'machines_edit');
dispatch_get    ('machines/:id',        'machines_view');
dispatch_put    ('machines/:id',        'machines_update');
dispatch_delete ('machines/:id',        'machines_delete');

// jobs controller
dispatch_get    ('jobs',                'jobs_index');
dispatch_post   ('jobs',                'jobs_create');
dispatch_get    ('jobs/new',            'jobs_new');
dispatch_get    ('jobs/:id/edit',       'jobs_edit');
dispatch_get    ('jobs/:id',            'jobs_view');
dispatch_put    ('jobs/:id',            'jobs_update');
dispatch_delete ('jobs/:id',            'jobs_delete');

run();
