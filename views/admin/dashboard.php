<?php

require('./model/ArticlesManager.php');
$articlesManager = new ArticlesManager($db);

$articles = $articlesManager->getAllArticles();

?>

<div class="dashboard">
    <input type="text" class="search-bar" placeholder="search articles">
    <div class="actions">
        <a href="#"><h3>All articles</h3></a>
        <a href="#"><h3>All users</h3></a>
    </div>
    <div class="articles">

        <?php foreach ($articles as $_article) { ?>

            <div class="article" data-id="<?= $_article->id ?>">
                <h2 class="title"><?= $_article->title ?></h2>
                <span class="author"> <?= $_article->author ?> </span>
                <span class="date"> <?= $_article->date ?> </span>
                <p class="text"> <?php
                    $text = substr($_article->text, 0, 200);
                    echo $text.'...';
                ?></p>

                <div class="buttons">
                    <a href="./articles/<?= $_article->id ?>" class="modify js-modify">Modify</a>
                    <button class="delete js-delete">Delete</button>
                </div>

            </div>

        <?php } ?>

    </div>
</div>

<script src="<?= $GLOBALS['path'] ?>./views/public/js/Dashboard.js"></script>