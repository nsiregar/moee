<?php

function login()
{
    try{
        auth_cookie($_COOKIE['username'], $_COOKIE['password']);
        header("Location: " . option('base_uri'));
        exit;
    } catch(Exception $e) {
        echo $e->getMessages();
        set("title", "Login");
        return html("auth/login.html.php", "layout/basic.html.php");
    }
}

function login_post()
{
    try{
        auth_login($_POST['username'], $_POST['password'], $_POST['rememberme']);
        header("Location: " . option('base_uri'));
        exit;
    } catch(Exception $e) {
        echo $e->getMessages();
        header("Location: " . option('base_uri') . "login?error=Please check your login credentials and try again.");
        exit;  
    }
}

function login_reset()
{
    set("title", "Reset Password");
    return html("security/reset.html.php", "layout/basic.html.php");
}

function login_reset_post()
{
    try{
        $user = get_user_mail(filter_var(params($_POST['email']), FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL));
        $pass = gen_password();
        $user_data = array(
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'password' => $pass,
            'email' => $user->email,
            'isadministrator' => $user->isadministrator,
            'createddate' => $user->createddate
         );
        $user = make_user_obj($user_data, $user);
        update_user_obj($user);
        mail($user->email, "Your New " . ApplicationName . " Password", "You recently requested a new password for " . ApplicationName . ". Your new password is " . $pass . ".\n\n--\n" . ApplicationName . "", "From: " . ApplicationName . " <" . EmailAddress . ">");
        header("Location: " . option('base_uri') . "login&success=Your password has been reset and a new one was just emailed to you!");
        exit;
    } catch(Exception $e) {
        echo $e->getMessages();
        header("Location: " . option('base_uri') . "login&error=Something went wrong, please contact our support team!");
        exit;        
    }
}

function logout()
{
    try{
        auth_logout();
        header("Location: " . option('base_uri') . "login");
        exit;        
    } catch(Exception $e) {
        echo $e->getMessages();
    }
}

function gen_password() {
    for ($i = 0; $i < 12; $i++)
    { 
        $d .= rand(1, 30) % 2; 
        $password .= $d ? chr(rand(65, 90)) : chr(rand(48, 57)); 
    }
    return $password;    
}
