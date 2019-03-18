<?php

session_start();

require('../model/model.php');
require('../model/MembersManager.php');

$membersManager = new MembersManager($db);

if ($membersManager->findMember($_POST)) {

    $_SESSION['logged']['user'] = $membersManager->findMember($_POST);
    $_SESSION['logged']['state'] = true;
    $_SESSION['success'] = 'Connected!';
    header('Location: ../');

} else {

    $_SESSION['errors'][] = 'User not found';
    header('Location: ../connection');

};