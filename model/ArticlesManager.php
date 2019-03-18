<?php

class ArticlesManager {

    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllArticles() {
        $req = $this->db->query('SELECT * FROM articles ORDER BY date DESC LIMIT 10');
        $articles = $req->fetchAll();
        return $articles;
    }

    public function postArticle(array $article) {
        
        $req = $this->db->prepare('INSERT INTO articles (title, text, author, date, claps) VALUES (:title, :text, :author, CURRENT_DATE, 0)');

        $req->execute([
            'title' => $article[0],
            'text' => $article[1],
            'author' => $article[2]
        ]);
    }

    public function updateArticle(array $article) {

        $req = $this->db->prepare('UPDATE articles SET title=:title, text=:text WHERE id=:id');

        $req->execute([
            'id' => $article[2],
            'title' => $article[0],
            'text' => $article[1]
        ]);
    }

    public function saveIllu($articleId = false) {

        if (!$articleId) {
            $req = $this->db->query('SELECT * FROM articles ORDER BY id DESC LIMIT 1');
            $res = $req->fetch();
            $id = $res->id++;
        } else {
            $id = $articleId;
        }
        
        $uploadDir = '../assets/images/';
        $uploadFile = $uploadDir . str_replace(' ', '', $_POST['title']) . $id . '.jpeg';

        if (move_uploaded_file($_FILES['illu']['tmp_name'], $uploadFile)) {
            echo 'ok';
        } else {
            echo 'Attaque potentielle par téléchargement de fichiers.';
        }
    }
}