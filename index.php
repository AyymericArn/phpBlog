<?php
ob_start();

session_start();

$url = $_GET['url'];
$GLOBALS['path']='';

$rootPath = getcwd();

// uncomment the first option for Mamp, second for Wamp

// $realPath = str_replace(
//     '\\',
//     '/',
//     preg_replace(
//         "#.*\/htdocs\//#",
//         "http://localhost/",
//         $rootPath
//     )
// );

$realPath = str_replace(
    '\\',
    '/',
    preg_replace(
        "#.*\www\\\#",
        "http://localhost/",
        $rootPath
    )
);

$GLOBALS['root'] = $realPath;

if (!isset($_SESSION['logged']['state'])) {
    $_SESSION['logged']['state'] = false;
}
if (!isset($_SESSION['logged']['admin'])) {
    $_SESSION['logged']['admin'] = false;
}

// database connection
include('model/model.php');

if ($url !== '') {

    // article
    if (substr($url, 0, 8) === 'articles') {
        $articleId = trim($url, 'articles/');

        $GLOBALS['path'] = '../';
        include('views/article.php');
    } else
    // clap
    if (substr($url, 0, 4) === 'clap') {
        $entityId = trim($url, 'clap/');

        $GLOBALS['path'] = '../';
        $entityType = 'article';
        include('controller/clap-like.php');
    } else
    // like
    if (substr($url, 0, 4) === 'like') {
        $entityId = trim($url, 'like/');

        $GLOBALS['path'] = '../';
        $entityType = 'comment';
        include('controller/clap-like.php');
    } else
    // comment
    if (substr($url, 0, 7) === 'comment') {
        $articleId = trim($url, 'comment/');

        include('controller/comment.php');
    } else
    // registration
    if (substr($url, 0, 12) === 'registration') {

        $GLOBALS['path'] = './';
        include('views/registration.php');
    } else
    // connection
    if (substr($url, 0, 10) === 'connection') {

        $GLOBALS['path'] = './';
        include('views/connection.php');
    } else
    // diconnection
    if (substr($url, 0, 13) === 'disconnection') {

        include('controller/disconnect.php');
    } else
    // write
    if (substr($url, 0, 5) === 'write') {
        
        include('views/write.php');
    } else
    // back-office
    if (substr($url, 0, 5) === 'admin') {
        
        include('views/admin/index.php');
    }

} else {
    // home
    include('views/home.php');
}

$content = ob_get_clean();

// header('Content-Type: text/html');
include('views/template.php');