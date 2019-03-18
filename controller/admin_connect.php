<?php

session_start();

if (isset($_POST['login']) && isset($_POST['password'])) {

    $login = $_POST['login'];
    $pass = md5($_POST['password']);

    if ($login === 'bruno' && $pass ==='e3928a3bc4be46516aa33a79bbdfdb08') {
       $_SESSION['logged']['admin'] = true;

        $adminUser = new stdClass();
        $adminUser->pseudo = 'bruno';

       $_SESSION['logged']['state'] = true;
       $_SESSION['logged']['user'] = $adminUser;
    } else {
        $_SESSION['errors'][] = 'Invalid login or password';
    }

    header('Location: ../admin');

} else {
    
    $_SESSION['errors'][] = 'Invalid inputs';
    header('Location: ../admin');

};