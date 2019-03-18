
<div class="errors">
    <?php

    if (!empty($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) : ?>

            <span class="error"> <?= $error ?> </span>

    <?php endforeach; 
    }; 

    $_SESSION['errors'] = [];

    ?>
</div>

<?php if (!$_SESSION['logged']['state']) { ?>

    <form action="./controller/register.php" method="POST" class="registration">
        <label for="pseudo">Pseudo</label>
        <input name="pseudo" type="text" placeholder="John Cena" id="pseudo">
        <label for="email">e-mail</label>
        <input name="email" type="email" placeholder="fan2benoitmagimel@gmail.com" id="email">
        <label for="password">Password</label>
        <input name="password" type="password" id="password">
    
        <input type="submit" value="confirmer">
    </form>
    
<?php } else {
    header('Location: ./');
} ?>



