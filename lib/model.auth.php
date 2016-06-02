<?php

function auth_login($username, $password, $rememberme = false)
{
    try{
        $user = get_user_auth(filter_var(params('username'), FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_SPECIAL_CHARS), md5(filter_var(params('password'), FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_SPECIAL_CHARS)));
        auth_refresh($user->id);
        if($rememberme == true){
            setcookie("username", $row['username'], time() + (60 * 60 * 24 * 7), "/", $_SERVER['HTTP_HOST'], true);
            setcookie("password", $row['password'], time() + (60 * 60 * 24 * 7), "/", $_SERVER['HTTP_HOST'], true);
        }
        return true;
    } catch(Exception $e){
    	echo $e->getMessages();
        return false;
    }
}

function auth_cookie($username, $password)
{
    try{
        $user = get_user_auth(filter_var(params('username'), FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_SPECIAL_CHARS), md5(filter_var(params('password'), FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_SPECIAL_CHARS)));
        auth_refresh($user->id);
        setcookie("username", $user->username, time() + (60 * 60 * 24 * 7), "/", $_SERVER['HTTP_HOST'], true);
        setcookie("password", $user->password, time() + (60 * 60 * 24 * 7), "/", $_SERVER['HTTP_HOST'], true);
        return true;
    } catch(Exception $e){
        echo $e->getMessages();
        return false;
    }
}

function auth_logout()
{
    session_destroy();
    setcookie("username", "", time() - (60 * 60), "/", $_SERVER['HTTP_HOST']);
    setcookie("password", "", time() - (60 * 60), "/", $_SERVER['HTTP_HOST']);
    return true;
}

function auth_authorize()
{
    if ($_SESSION['user_id'] == null)
    {
        header("Location: " . option('base_uri') . "login");
        exit;
    }
}

function auth_refresh($id)
{
	try{
		$user = get_user_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
		$_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username];
        $_SESSION['name'] = $user->name;
        $_SESSION['isadministrator'] = $user->isadministrator;
	} catch(Exception $e){
		echo $e->getMessages();
	}
}