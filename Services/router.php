<?php

class Router
{
    private UserController $userController;
    private HomepageController $homepageController;
    private MessageController $messageController; // Ajout pour le contrôleur de messages
    private AdminController $adminController;
    private EventController $eventController;
    private ServiceController $serviceController;

    public function __construct()
    {
        $this->userController = new UserController();
        $this->homepageController = new HomepageController();
        $this->messageController = new MessageController();
        $this->adminController = new AdminController(); // Initialisation du contrôleur de messages
        $this->eventController = new EventController();
        $this->serviceController = new ServiceController();
    }
    
    
    
    
    
        

public function checkRoute($route): void
{
    
     if (empty($route)) {
        $route = 'accueil'; // Si $route est vide, on le définit à 'accueil'
    }
    
    $routeParts = explode("/", $route);

     if ($routeParts[0] === 'accueil') {
        $this->homepageController->index();
    } elseif ($routeParts[0] === 'services') {
        $this->homepageController->services();
    } elseif ($routeParts[0] === 'deconnexion') {
        $this->userController->logout();
    } elseif ($routeParts[0] === 'connexion') {
        $this->userController->login();
    } elseif ($routeParts[0] === 'créer-un-compte') {
        $this->userController->register();
    } elseif ($routeParts[0] === 'update_profile') {
        $this->userController->updateUserProfile();
    }  elseif ($routeParts[0] === 'view_message') {
        $this->messageController->viewMessage($_GET['id']);
    } elseif ($routeParts[0] === 'create_message') {
        $this->messageController->create();
    } elseif ($routeParts[0] === 'update_message') {
        $this->messageController->update($_GET['id']);
    } elseif ($routeParts[0] === 'edit_message') {
        $this->messageController->edit($_GET['id']);
    } elseif ($routeParts[0] === 'delete_message') {
        $this->messageController->deleteMessage($_GET['id']);
    } elseif ($routeParts[0] === 'administrer') {
        $this->adminController->manageUsers();
    } elseif ($routeParts[0] === 'messages') {
        $this->adminController->manageMessages();
    }  elseif ($routeParts[0] === 'edit_user') {
        $this->adminController->editUser($_GET['id']);  
    } elseif ($routeParts[0] === 'delete_user') {
        $this->adminController->deleteUser($_GET['id']);  
    } elseif ($routeParts[0] === 'event_index') {
        $this->eventController->eventIndex();
    } elseif ($routeParts[0] === 'show_event') {
        $this->eventController->viewEvent($_GET['id']);
    } elseif ($routeParts[0] === 'create_event') {
        $this->eventController->createEvent();
    } elseif ($routeParts[0] === 'create_event_user') {
        $this->eventController->createEventUser();
    } elseif ($routeParts[0] === 'store_event') {
        $this->eventController->store();
    } elseif ($routeParts[0] === 'delete_event') {
        $this->eventController->deleteEvent($_GET['id']);
    } elseif ($routeParts[0] === 'calendar_admin') {
        $this->eventController->getEvents();
    } elseif ($routeParts[0] === 'calendar_user') {
        $this->eventController->getEventsUser();
    } elseif ($routeParts[0] === 'event_index_user') {
        $this->eventController->getEventsIndexForUser();
    }elseif ($routeParts[0] === 'getServices') {
        $this->eventController->getServices();
    }elseif ($routeParts[0] === 'update_services') {
         $this->serviceController->updateServices();
    }elseif ($routeParts[0] === 'legal_notice') {
         $this->homepageController->legalNotice();
    }elseif ($routeParts[0] === 'faq') {
         $this->homepageController->faq();
    } else {
            // handle the case where no route matches
        $this->homepageController->index();
        }
    }
}