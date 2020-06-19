<?php

class ContactMessage {
    public $id;
    public $name;
    public $email;
    public $message;

    public function isValid(): bool {
        $regex = "/^[a-z0-9][a-z0-9._-]*@[a-z0-9_-]{2,}(\.[a-z]{2,4}){1,2}$/";
        return 
            $this->name !== null && strlen($this->name) > 3 &&
            $this->email !== null && preg_match($regex, $this->email) &&
            $this->message !== null && strlen($this->message) > 10;
    }
}