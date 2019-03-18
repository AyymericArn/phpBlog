<?php

session_start();

require('../model/model.php');
require('../model/ArticlesManager.php');

$articlesManager = new ArticlesManager($db);

// update existing article
if (isset($_GET['action']) && $_GET['action'] === 'update') {
    
    if (isset($_POST['title']) && isset($_POST['text'])) {
        $articlesManager->updateArticle([
            htmlspecialchars($_POST['title']),
            htmlspecialchars($_POST['text']),
            (int)$_SESSION['articleId']
        ]);
    }
    $articlesManager->saveIllu((int)$_SESSION['articleId']);
    
    $_SESSION['success'] = 'article updated !';

} else {

// create new article
    if (isset($_POST['title']) && isset($_POST['text'])) {
        $articlesManager->postArticle([
            htmlspecialchars($_POST['title']),
            htmlspecialchars($_POST['text']),
            $_SESSION['logged']['user']->pseudo
        ]);
    }
    $articlesManager->saveIllu();
    
    $_SESSION['success'] = 'article published !';
}

header('Location: ../');