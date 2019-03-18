<div class="container">
    <input type="text" class="search-bar"  name="search-bar" id="search-bar" placeholder="search an article">
    <div class="search-results"></div>
    <?php
        $req = $db->query('SELECT * FROM articles ORDER BY date DESC LIMIT 10');
        $articles = $req->fetchAll();

        foreach ($articles as $_article) : ?>

            <a href="articles/<?= $_article->id ?>">
                <div class="article">

                    <h2 class="title"> <?= $_article->title ?></h2>
                    <span class="author"> by : <?= $_article->author ?></span><br>
                    <span class="date"> date : <?= $_article->date ?></span><br>
                    <span class="claps"> claps : <?= $_article->claps ?></span><br>

                    <?php if (file_exists("assets/images/".str_replace(' ', '', $_article->title).$_article->id.".jpeg")) { ?>
                        <img class="illu" src="assets/images/<?= str_replace(' ', '', $_article->title).$_article->id ?>.jpeg" />
                    <?php } ?>

                    <p class="text"> <?php
                        $text = substr($_article->text, 0, 500);
                        echo $text.'...';
                    ?></p>

                </div>
            </a>

        <?php endforeach;
    ?>
</div>