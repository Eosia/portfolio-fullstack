<?php
require_once('model/ContactMessage.php');

class ContactManager {

    public function getConnection(): PDO{
        $db = new PDO("mysql:host=localhost;dbname=keviqffq_realisations;charset=utf8","keviqffq_kevin","kevinportfolio");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }

    public function create(ContactMessage $message){
        $db = $this->getConnection();
        $request = $db->prepare("INSERT INTO `messages` (`name`,`email`,`message`) VALUES (:name, :email, :message)");
        $request->execute([
            'name'=>$message->name,
            'email'=>$message->email,
            'message'=>$message->message
        ]);
    }
}