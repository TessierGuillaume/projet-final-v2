<?php

class HomepageController extends AbstractController
{
        // Méthode pour afficher la page d'accueil

    public function index()
    {
        // Pas besoin de vérifier si l'utilisateur est connecté pour afficher la page d'accueil
        $this->render('public/homepage.phtml', []);
    }
    // Méthode pour afficher la page des services

    public function services()
    {
        // Récupération des services de la base de données
        $serviceManager = new ServiceManager(); 
        $services = $serviceManager->getAllServices();

        
        $this->render('public/services/services.phtml', ['services' => $services]);
    }
        // Méthode pour gérer la page de contact

    public function contact()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $name = htmlspecialchars($_POST['contactName']);
            $email = htmlspecialchars($_POST['contactEmail']);
            $message_body = htmlspecialchars($_POST['contactMessage']);


            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                // Insérer le message dans la base de données
                $messageManager = new MessageManager(); 
                $messageManager->createMessage($user_id, $name, $email, $message_body);

               
                header('Location:/projet-final-v2/contact_thank_you');
                exit();
            }
        } else {
            // Afficher le formulaire de contact
            $this->render('public/contact/contact.phtml');
        }
    }
    
    
        // Méthode pour afficher les mentions légales
    public function legalNotice()
{
   $this->render('templates/public/legal_notice/legal_notice.phtml');
}
    // Méthode pour afficher la FAQ
    public function faq()
{
   $this->render('templates/public/faq/faq.phtml');
}
}
