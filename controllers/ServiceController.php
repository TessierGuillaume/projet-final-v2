<?php

class ServiceController extends AbstractController
{
    private $serviceManager;

    public function __construct()
    {
        $this->serviceManager = new ServiceManager(); // Ou toute autre logique d'initialisation nécessaire
    }

    // Méthode pour récupérer tous les services au format JSON
    public function getAllServicesJson()
{
    try {
        $services = $this->serviceManager->getAllServices();
        header('Content-Type: application/json');
        echo json_encode($services);
    } catch (Exception $e) {
        // Vous pouvez ici logger l'erreur ou la renvoyer
        http_response_code(500);
        echo json_encode(['error' => 'Une erreur est survenue']);
    }
}
// Méthode pour lister tous les services
    public function listServices() 
    {
        $services = $this->serviceManager->getAllServices(); // Utilisation de la propriété $eventManager
        $this->render('public/calendar/calendar.phtml', ['service_list' => $services]);
    }
    
    // Méthode pour afficher la page des services
    public function showServicesPage()
{
    $services = $this->serviceManager->getAllServices();
    $this->render('public/services/services.phtml', ['services' => $services]);

}

 // Méthode pour mettre à jour un service
    public function updateServices() {
    try {
        // Vérification de l'authentification et de l'autorisation
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            throw new Exception("Vous n'êtes pas autorisé à effectuer cette action.");
        }

        // Vérification de l'existence de l'ID dans les paramètres GET ou POST
        if (isset($_GET['Service_ID'])) {
            $id = $_GET['Service_ID'];
        } elseif (isset($_POST['Service_ID'])) {
            $id = $_POST['Service_ID'];
        } else {
            throw new Exception("ID du service non fourni.");
        }

        // Récupération du service par l'ID
        $service = $this->serviceManager->getServiceById($id);
        if (!$service) {
            throw new Exception("Service non trouvé.");
        }

        // Traitement du formulaire de mise à jour
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['Service_name']) && isset($_POST['Service_cost']) && isset($_POST['Vehicle_type'])) {
                $name = htmlspecialchars($_POST['Service_name']);
                
                // Validation du coût
                if (!is_numeric($_POST['Service_cost'])) {
                    throw new Exception("Le coût du service doit être un nombre.");
                }
                $cost = $_POST['Service_cost'];

                $vehicle_type = htmlspecialchars($_POST['Vehicle_type']);

                $this->serviceManager->updateService($id, $name, $cost, $vehicle_type);
                header('Location: /projet-final-v2/services');
                exit();
            } else {
                throw new Exception("Données POST incomplètes.");
            }
        }

        
        $this->render('public/services/services.phtml', ['service' => $service]);
    } catch (Exception $e) {
        // Gestion des erreurs
        $this->render('public/404/404.phtml', ['error_message' => $e->getMessage()]);
    }
}



}