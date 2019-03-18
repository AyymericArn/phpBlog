<?php

if (!isset($modification)) {
    $modification = false;
} else {
    $_SESSION['articleId'] = $article->id;
}


if (!$_SESSION['logged']['state'] && !$_SESSION['logged']['admin']) {
    header('Location: ./connection.php');
} else { ?>
    
    <form enctype="multipart/form-data" class="write" action="<?= $modification ? '..' : '.' ?>/controller/write_article.php<?= $modification ? '?action=update' : '' ?>" method="post">
        <label for="title">Title</label>
        <input value="<?= $modification ? $article->title : '' ?>" type="text" name="title" id="title">

        <?php if ($modification && file_exists('./assets/images/'.str_replace(' ', '', $article->title).$article->id.'.jpeg')) { ?>
            <img class="illu" src="../assets/images/<?= str_replace(' ', '', $article->title).$article->id ?>.jpeg" />
            <label for="illu">Modify illustration</label>
            <input value="Modify illustration" type="file" name="illu" id="illu" accept="image/png, image/jpeg">
        <?php } ?>

        <label for="text"><?= !$modification ? "What's the news?" : 'Your text : ' ?></label>
        <textarea style="resize: none" name="text" id="text" cols="30" rows="10"><?= $modification ? $article->text : '' ?></textarea>

        <?php if (!$modification) { ?>
            <label for="illu">Upload an illustration for you post</label>
            <input type="file" name="illu" id="illu" accept="image/png, image/jpeg">           
        <?php } ?>

        <input type="submit" value="Submit">
    </form>

<?php } ?>