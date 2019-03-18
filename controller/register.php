<?php

session_start();

require('../model/model.php');
require('../model/MembersManager.php');

class Validator {

    private $errors = [];
    private $pseudo;
    private $email;
    private $password;
    private $db;

    public function __construct( array $data, PDO $db ) {

        $this->hydrate( $data, $db );
        $this->checkUsername();
        $this->checkEmail();
        $this->checkPassword();
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getData() {
        return [
            $this->pseudo,
            $this->email,
            $this->password
        ];
    }

    public function hydrate( array $data, PDO $db ) {
        $this->pseudo = htmlspecialchars($data['pseudo']);
        $this->email = htmlspecialchars($data['email']);
        $this->password = htmlspecialchars($data['password']);
        $this->db = $db;
    }

    public function checkUsername() {
        if (!preg_match('/^[a-z0-9_-]{3,16}$/', $this->pseudo)) {
            $this->errors[] = 'Username not valid';
        }
        if (strlen($this->pseudo) < 1) {
            $this->errors[] = 'Username too short';
        }
    }

    public function checkEmail() {

        $mails = $this->db->query('SELECT email FROM members')->fetchAll();

        foreach ($mails as $mail) {
            if ($mail->email === $this->email) {
                $this->errors[] = 'Mail already existing';
            }
        }

        if (!preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/', $this->email)) {
            $this->errors[] = 'Please enter a valid email';
        }

        // if (strlen($this->password) < 5) {
        //     $this->errors[] = 'Password too short';
        // }
    }

    public function checkPassword() {
        if (strlen($this->password) < 5) {
            $this->errors[] = 'Password too short';
        }
    }

};

$validator = new Validator($_POST, $db);

$_SESSION['errors'] = $validator->getErrors();

if (empty($_SESSION['errors'])) {

    $membersManager = new MembersManager($db);
    $membersManager->registerMember($validator->getData());
    $_SESSION['success'] = 'Connected!';
    header('Location: ../');

} else {

    header('Location: ../registration');

};