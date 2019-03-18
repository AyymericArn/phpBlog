<?php

include('model/CommentsManager.php');

if ($_SESSION['logged']['state']) {

    $commentsManager = new CommentsManager($db, $_POST['comment'], $articleId);
    $commentsManager->insertComment();
    $_SESSION['success'] = 'Comment posted !';

    echo 'crotte !';
    header('Location: ../articles/'.$articleId);
    
} else {
    $_SESSION['errors'][] = 'Cannot comment : you must be connected';
    header('Location: ../articles/'.$articleId);
}