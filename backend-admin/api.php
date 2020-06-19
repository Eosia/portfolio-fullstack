<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8bin');
header('Access-Control-Allow-Headers: Content-Type, origin');
header('Access-Control-Allow-Methods: POST, OPTIONS');

require_once('dashboard/models/Realisation.class.php');
require_once('dashboard/models/Model.class.php');
require_once('dashboard/models/RealisationManager.class.php');
require_once('dashboard/models/Service.class.php');
require_once('dashboard/models/ServiceManager.class.php');
require_once('model/ContactMessage.php');
require_once('model/ContactManager.php');

switch ($_GET['entity']) {
    case "realisation":
        $manager = new RealisationManager();

        $data = $manager->getRealisations('Realisations');

        echo json_encode($data);
        break;
    
    case "service":
        $manager = new ServiceManager();

        $data = $manager->getServices('Services');

        echo json_encode($data);
        break;

    case "contactMessage":
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit;
        }

        $manager = new ContactManager();

        $data = json_decode(file_get_contents('php://input'), true);

        if(isset($data['name']) && isset($data['email']) && isset($data['message'])) {
            $name = filter_var($data['name'], FILTER_SANITIZE_STRING);
            $email = filter_var($data['email'], FILTER_SANITIZE_STRING);
            $message = filter_var($data['message'], FILTER_SANITIZE_STRING);

            $contactMessage = new ContactMessage;
            $contactMessage->name = $name;
            $contactMessage->email = $email;
            $contactMessage->message = $message;

            if($contactMessage->isValid()) {
                $manager->create($contactMessage);
            }else{
                header("HTTP/1.0 400 Invalid Data");
            }
        }else{
            header("HTTP/1.0 400 JSON Problem");
        }

        break;
}