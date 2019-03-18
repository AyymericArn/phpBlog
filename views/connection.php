<?php if (!$_SESSION['logged']['state']) { ?>

    <form action="./controller/connect.php" method="POST" class="registration">
        <label for="email">e-mail</label>
        <input name="email" type="email" placeholder="fan2benoitmagimel@gmail.com" id="email">
        <label for="password">Password</label>
        <input name="password" type="password" id="password">
    
        <input type="submit" value="confirmer">
    </form>
    
<?php } else {
    header('Location: ./');
} ?>

