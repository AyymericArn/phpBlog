<header>
    <div class="header">
        <a href="<?= $GLOBALS['root'] ?>"><span class="logo">Medium</span></a>

        <?php if (!$_SESSION['logged']['state']) { ?>
            <div class="sign-in">
                <a class="connect" href="<?= $GLOBALS['root'] ?>/connection">Connect</a>
                <a class="register" href="<?= $GLOBALS['root'] ?>/registration">Register</a>
            </div>
        <?php } else { ?>
            <div class="sign-in">
                <a class="connect" href="<?= $GLOBALS['root'] ?>/disconnection">Disconnect</a>
            </div>
        <?php } ?>
    </div>

    <!-- display errors -->
    <?php

        if (!empty($_SESSION['errors'])) { ?>

            <div class="errors">
                <?php foreach ($_SESSION['errors'] as $error) : ?>

                    <span class="error"> <?= $error ?> </span>

                <?php endforeach; ?>
            <span class="close">X</span>
            </div>
        <?php };

        $_SESSION['errors'] = [];

    ?>
    </div>

    <!-- display successes -->
    <?php

    if (!empty($_SESSION['success'])) { ?>

        <div class="successes">
            <span class="success"> <?= $_SESSION['success'] ?> </span>
            <span class="close">X</span>
        </div>

        <?php }; 

        $_SESSION['success'] = [];

    ?>
</header>