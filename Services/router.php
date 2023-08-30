<?php

class Router
{
    private UserController $userController;
    private HomepageController $homepageController;
    private MessageController $messageController; // Ajout pour le contrôleur de messages
    private AdminController $adminController;
    private AppointmentController $appointmentController;
    private EventController $eventController;

    public function __construct()
    {
        $this->userController = new UserController();
        $this->homepageController = new HomepageController();
        $this->messageController = new MessageController();
        $this->adminController = new AdminController(); // Initialisation du contrôleur de messages
        $this->appointmentController = new AppointmentController();
        $this->eventController = new EventController();
    }

    public function checkRoute($route): void
    {
        if ($route === 'homepage') { // Ajout de la nouvelle route pour la page d'accueil
            $this->homepageController->index();
        } elseif ($route === 'services') {
            $this->homepageController->services();
        } elseif ($route === 'logout') {
            $this->userController->logout();
        } elseif ($route === 'login') {
            $this->userController->login();
        } elseif ($route === 'register') {
            $this->userController->register();
        } elseif ($route === 'update_profile') {
            $this->userController->updateUserProfile();
        } elseif ($route === 'index_message') {
            $this->messageController->index(); // Route pour l'index des messages
        } elseif ($route === 'view_message') {
            $this->messageController->viewMessage($_GET['id']); // Route pour afficher un message
        } elseif ($route === 'create_message') {
            $this->messageController->create(); // Route pour créer un message
        } elseif ($route === 'update_message') {
            $this->messageController->update($_GET['id']); // Route pour mettre à jour un message
        } elseif ($route === 'edit_message') {
            $this->messageController->edit($_GET['id']); // Route pour éditer un message
        } elseif ($route === 'delete_message') {
            $this->messageController->deleteMessage($_GET['id']); // Route pour supprimer un message
        } elseif ($route === 'users') {
            $this->adminController->manageUsers();
        } elseif ($route === 'messages') {
            $this->adminController->manageMessages();
        } elseif ($route === 'admin/edit_user') {
            $this->adminController->editUser($_GET['id']);
        } elseif ($route === 'admin/delete_user') {
            $this->adminController->deleteUser($_GET['id']);
        } elseif ($route === 'admin/update_user') {
            $this->adminController->updateUser($_GET['id']);
        } elseif ($route === 'create_appointment') {
            $this->appointmentController->create();
        } elseif ($route === 'store_appointment') {
            $this->appointmentController->store();
        } elseif ($route === 'index_appointment') {
            $this->appointmentController->index();
        } elseif ($route === 'show_appointment') {
            $this->appointmentController->show($_GET['id']);
        } elseif ($route === 'edit_appointment') {
            $this->appointmentController->edit($_GET['id']);
        } elseif ($route === 'update_appointment') {
            $this->appointmentController->update($_GET['id']);
        } elseif ($route === 'delete_appointment') {
            $this->appointmentController->delete($_GET['id']);
        } elseif ($route === 'thank_you') {
            $this->appointmentController->thankYou();
        } elseif ($route === 'fetch_appointments') {
            $this->appointmentController->getAppointments();
        } elseif ($route === 'create_appointment') {
            $this->appointmentController->create();
        } elseif ($route === 'event_index') {
            $this->eventController->eventIndex();
        } elseif ($route === 'show_event') {
            $this->eventController->viewEvent($_GET['id']);
        } elseif ($route === 'create_event') {
            $this->eventController->createEvent();
        } elseif ($route === 'create_event_user') {
            $this->eventController->createEventUser();
        } elseif ($route === 'store_event') {
            $this->eventController->store();
        } elseif ($route === 'delete_event') {
            $this->eventController->deleteEvent($_GET['id']);
        } elseif ($route === 'calendar_admin') {
            $this->eventController->getEvents();
        } elseif ($route === 'calendar_user') {
            $this->eventController->getEventsUser();
        } elseif ($route === 'event_index_user') {
            $this->eventController->getEventsIndexForUser();
        } else {
            $this->homepageController->index();
        }
    }
}
