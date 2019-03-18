<?php

class MembersManager {

    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function registerMember(array $nuMember) {
        $req = $this->db->prepare('INSERT INTO members (pseudo, email, password, inscription_date) VALUES (:pseudo, :email, :password, CURRENT_DATE)');

        $req->execute([
            'pseudo' => $nuMember[0],
            'email' => $nuMember[1],
            'password' => $nuMember[2]
        ]);
    }

    public function findMember(array $member) {
        $req = $this->db->prepare('SELECT * FROM members WHERE email=:email AND password=:password');

        $req->execute([
            'email' => $member['email'],
            'password' => $member['password']

        ]);

        return $req->fetch();
    }
}