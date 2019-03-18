<?php

require('../model.php');
parse_str( file_get_contents('php://input'), $data);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'DELETE':

    try {
        $articleId = $data['id'];

        // delete article
        $req = $db->prepare('DELETE FROM articles WHERE id=:id');

        $req->execute(['id' => $articleId]);

        // delete comments
        $req = $db->prepare('DELETE FROM comments WHERE id_article=:id');

        $req->execute(['id' => $articleId]);

        echo json_encode('ok');
    } catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
        break;

    case 'GET':

    try {
        $query = $_GET['query'];

        // search in articles
        $reqArticles = $db->query('SELECT id, title FROM articles WHERE (lower(title) LIKE \'' . $query . '%\')');

        $resArticles = $reqArticles->fetchAll();

        // search in users
        $reqUsers = $db->query('SELECT pseudo FROM members WHERE (lower(pseudo) LIKE \'' . $query . '%\')');

        $resUsers = $reqUsers->fetchAll();
        
        if (empty($resArticles) && empty($resUsers)) {
            // search in articles
            $reqArticles = $db->query('SELECT id, title FROM articles WHERE (lower(title) LIKE \'%' . $query . '%\')');
    
            $resArticles = $reqArticles->fetchAll();
    
            // search in users
            $reqUsers = $db->query('SELECT pseudo FROM members WHERE (lower(pseudo) LIKE \'%' . $query . '%\')');
    
            $resUsers = $reqUsers->fetchAll();
            # code...
        }
        
        $response = json_encode([$resArticles, $resUsers]);

        echo $response;
    } catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
        break;
    
    default:
        echo json_encode('no action specified');
        break;
}