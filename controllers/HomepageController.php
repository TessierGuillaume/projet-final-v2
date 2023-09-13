<?php

class HomepageController extends AbstractController
{
    public function index()
    {
        // Pas besoin de vérifier si l'utilisateur est connecté pour afficher la page d'accueil
        $this->render('public/homepage.phtml', []);
    }

    public function services()
    {
        // Récupération des services de la base de données
        $serviceManager = new ServiceManager(); // Assumer que vous avez une classe pour gérer les services
        $services = $serviceManager->getAllServices();

        // Transmettre les services à la vue
        $this->render('public/services/services.phtml', ['services' => $services]);
    }

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
                $messageManager = new MessageManager(); // Assumer que vous avez une classe pour gérer les messages
                $messageManager->createMessage($user_id, $name, $email, $message_body);

                // Rediriger vers une page de confirmation ou de remerciement
                header('Location:/projet-final-v2/contact_thank_you');
                exit();
            }
        } else {
            // Afficher le formulaire de contact
            $this->render('public/contact/contact.phtml');
        }
    }
}
