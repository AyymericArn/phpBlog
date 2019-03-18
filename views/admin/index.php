<?php

if (!$_SESSION['logged']['admin']) {
    require('./views/admin/admin_connection.php');
} else {
    require('./views/admin/dashboard.php');
}