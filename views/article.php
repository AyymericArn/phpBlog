<?php

// gets article
$article = $db->query('SELECT * FROM articles WHERE id='.$articleId)->fetch();

// gets comments and associated likes with tables join
// $comments = $db->query('SELECT c.id, c.author, c.date, c.text, COUNT(l.id) FROM comments c RIGHT JOIN liked_entities l ON l.id_entity = c.id WHERE c.id_article='.$articleId.' ORDER BY c.date DESC')->fetchAll();

// gets comments and associated likes
$comments = $db->query('SELECT * FROM comments WHERE id_article='.$articleId.' ORDER BY date DESC')->fetchAll();

// gets likes
$articleLikes = $db->query('SELECT COUNT(*) FROM liked_entities WHERE id_entity='.$articleId.' AND entity_type=\'article\'')->fetch();

// prepares to get comment likes
$commentLikesReq = $db->prepare('SELECT COUNT(*) FROM liked_entities WHERE id_entity=? AND entity_type=\'comment\'');

// stores users information in a variable
$_SESSION['logged']['state'] ? $user = $_SESSION['logged']['user'] : '';
$_SESSION['logged']['state'] ? $logged = $_SESSION['logged']['state'] : $logged = false;

// if the user is logged in with the good account or as administrator, enables him to modify the article
if ((isset($user) && $article->author === $user->pseudo) || $_SESSION['logged']['admin']) {
    $modifyMode = true;
} else {
    $modifyMode = false;
}

?>


<?php if (!$modifyMode) { ?>
    <div class="article_wrapper">
        <h1 class="title"> <?= $article->title ?></h1>
        <span class="author"> <?= $article->author ?></span>
        <span class="date"> <?= $article->date ?></span>
    
        <?php if (file_exists('./assets/images/'.str_replace(' ', '', $article->title).$article->id.'.jpeg')) { ?>
            <img class="illu" src="../assets/images/<?= str_replace(' ', '', $article->title).$article->id ?>.jpeg" />
        <?php } ?>
    
        <p class="text"><?php
            echo $article->text;
        ?></p>
    
        <form action="../clap/<?= $article->id ?>">
            <span class="clap_number"><?= $articleLikes->{'COUNT(*)'} ?></span>
            <input <?= !$logged ? 'disabled' : '' ?> type="submit" class="clap" value="">
            <svg width="25" height="25">
                <g fill-rule="evenodd">
                    <path d="M11.739 0l.761 2.966L13.261 0z"></path><path d="M14.815 3.776l1.84-2.551-1.43-.471z"></path><path d="M8.378 1.224l1.84 2.551L9.81.753z"></path><path d="M20.382 21.622c-1.04 1.04-2.115 1.507-3.166 1.608.168-.14.332-.29.492-.45 2.885-2.886 3.456-5.982 1.69-9.211l-1.101-1.937-.955-2.02c-.315-.676-.235-1.185.245-1.556a.836.836 0 0 1 .66-.16c.342.056.66.28.879.605l2.856 5.023c1.179 1.962 1.379 5.119-1.6 8.098m-13.29-.528l-5.02-5.02a1 1 0 0 1 .707-1.701c.255 0 .512.098.707.292l2.607 2.607a.442.442 0 0 0 .624-.624L4.11 14.04l-1.75-1.75a.998.998 0 1 1 1.41-1.413l4.154 4.156a.44.44 0 0 0 .624 0 .44.44 0 0 0 0-.624l-4.152-4.153-1.172-1.171a.998.998 0 0 1 0-1.41 1.018 1.018 0 0 1 1.41 0l1.172 1.17 4.153 4.152a.437.437 0 0 0 .624 0 .442.442 0 0 0 0-.624L6.43 8.222a.988.988 0 0 1-.291-.705.99.99 0 0 1 .29-.706 1 1 0 0 1 1.412 0l6.992 6.993a.443.443 0 0 0 .71-.501l-1.35-2.856c-.315-.676-.235-1.185.246-1.557a.85.85 0 0 1 .66-.16c.342.056.659.28.879.606L18.628 14c1.573 2.876 1.067 5.545-1.544 8.156-1.396 1.397-3.144 1.966-5.063 1.652-1.713-.286-3.463-1.248-4.928-2.714zM10.99 5.976l2.562 2.562c-.497.607-.563 1.414-.155 2.284l.265.562-4.257-4.257a.98.98 0 0 1-.117-.445c0-.267.104-.517.292-.706a1.023 1.023 0 0 1 1.41 0zm8.887 2.06c-.375-.557-.902-.916-1.486-1.011a1.738 1.738 0 0 0-1.342.332c-.376.29-.61.656-.712 1.065a2.1 2.1 0 0 0-1.095-.562 1.776 1.776 0 0 0-.992.128l-2.636-2.636a1.883 1.883 0 0 0-2.658 0 1.862 1.862 0 0 0-.478.847 1.886 1.886 0 0 0-2.671-.012 1.867 1.867 0 0 0-.503.909c-.754-.754-1.992-.754-2.703-.044a1.881 1.881 0 0 0 0 2.658c-.288.12-.605.288-.864.547a1.884 1.884 0 0 0 0 2.659l.624.622a1.879 1.879 0 0 0-.91 3.16l5.019 5.02c1.595 1.594 3.515 2.645 5.408 2.959a7.16 7.16 0 0 0 1.173.098c1.026 0 1.997-.24 2.892-.7.279.04.555.065.828.065 1.53 0 2.969-.628 4.236-1.894 3.338-3.338 3.083-6.928 1.738-9.166l-2.868-5.043z"></path>
                </g>
            </svg>
        </form>
    
    </div>
    
    <?php } else { 
        
        // if article is modifiable, call the writing form, precising values are already existing for each field
        $modification = true;
        require('write.php');

        ?>

        <form action="../delete/<?= $article->id ?>">
            <input type="submit" class="delete" value="Delete article">
        </form>

        <?php

} ?>


<div class="article_comments">
    <form 
        class="article_comment" 
        action="../comment/<?= $article->id ?>"
        method="post"
    >
    
        <!-- <input type="text" name="comment" id="comment"> -->
        <div class="self">
            <?php if ($logged) { ?>
                <!-- <img class="name"> -->
                <span class="name">
                    <?= $user->pseudo.' :' ?>
                </span>
                <textarea placeholder="Your comment" style="resize: none" name="comment" id="comment" cols="60" rows="2"></textarea>
                <input type="submit" value="Publish">
            <?php } else { ?>
                <a href="../connection">
                    <textarea disabled placeholder="Please connect to comment" style="resize: none" name="comment" id="comment" cols="60" rows="2"></textarea>
                </a>
            <?php } ?>
        </div>
    </form>

<!--
   _                _            _                                
 | |              (_)        _ | |                               
 | |  ___    __ _  _  _ __  (_)| |__   _ __  _   _  _ __    ___  
 | | / _ \  / _` || || '_ \    | '_ \ | '__|| | | || '_ \  / _ \ 
 | || (_) || (_| || || | | | _ | |_) || |   | |_| || | | || (_) |
 |_| \___/  \__, ||_||_| |_|(_)|_.__/ |_|    \__,_||_| |_| \___/ 
             __/ |                                               
            |___/     
-->


    <div class="comments">
        <?php foreach ($comments as $comment) {

            $commentLikesReq->execute([$comment->id]);
            $commentLikes = $commentLikesReq->fetch();
            
        ?>
            <div class="comment">
                <span class="author"> <?= $comment->author ?> </span>
                <span class="date"> <?= $comment->date ?> </span>
                <p class="text"> <?= $comment->text ?> </p>


                <a class="js-like" href="../like/<?= $comment->id ?>&article=<?= $article->id ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                    <span class="likes"> <?= $commentLikes->{'COUNT(*)'} ?> </span>
                </a>
                
            </div>
        <?php } ?>
    </div>
</div>