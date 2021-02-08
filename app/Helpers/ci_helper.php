<?php

declare(strict_types=1);

function is_login(): void
{
    $CI =& get_instance();

    if ($CI->session->userdata('login') != false) {
        return;
    }

    $CI->session->set_flashdata('error', 'Please sign in.');
    redirect_('login');
}

function is_admin(): void
{
    $CI =& get_instance();

    is_login();

    if ($CI->session->userdata('role') == 1) {
        return;
    }

    redirect_('errors');
}

function hashEncrypt($input)
{
    return password_hash($input, PASSWORD_DEFAULT);
}

function hashEncryptVerify($input, $hash)
{
    if (password_verify($input, $hash)) {
        return true;
    }

    return false;
}

//function dd($input): void
//{
//    var_dump($input);
//    die;
//}
