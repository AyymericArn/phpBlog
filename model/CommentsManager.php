<?php

class CommentsManager {

    private $db;
    private $comment;
    private $articleId;
    private $user;

    public function __construct(PDO $db, string $comment, string $articleId) {
        $this->hydrate($db, $comment, $articleId, $_SESSION['logged']['user']);
    }
    
    public function hydrate($db, $comment, $articleId, $user) {
        $this->db = $db;
        $this->comment = htmlspecialchars($comment);
        $this->articleId = $articleId;
        $this->user = $user;
    }

    public function insertComment() {
        $req = $this->db->prepare('INSERT INTO comments (id_article, author, text, date, likes) VALUES (:id_article, :author, :text, CURRENT_DATE, 0)');

        $req->execute([
            'id_article' => $this->articleId,
            'author' => $this->user->pseudo,
            'text' => $this->comment
        ]);
    }
};