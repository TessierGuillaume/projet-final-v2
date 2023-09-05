<?php

class ServiceController
{
    // Supposons que vous ayez un ServiceManager ou un modèle similaire pour interagir avec vos services
    private $serviceManager;

    public function __construct()
    {
        $this->serviceManager = new ServiceManager(); // Ou toute autre logique d'initialisation nécessaire
    }
    
    public function showServicesPage() {
    require 'public/services/services.phtml';
}

    // Méthode pour afficher la page de contrôle technique
    public function technicalControl()
    {
        // Vous pouvez récupérer les détails spécifiques du service de contrôle technique ici
        $service = $this->serviceManager->getTechnicalControlService();

        // Passez le service au template si nécessaire
        $template = 'public/services/services.phtml'; // chemin vers le fichier phtml pour le contrôle technique

        // Vous incluez le layout ici, qui inclura ensuite le template spécifié
        require 'templates/layout.phtml';
    }

    // Méthode pour afficher la page de contre-visites
    public function reinspection()
    {
        // Vous pouvez récupérer les détails spécifiques du service de contre-visites ici
        $service = $this->serviceManager->getReinspectionService();

        // Passez le service au template si nécessaire
        $template = 'reinspection'; // chemin vers le fichier phtml pour les contre-visites

        // Vous incluez le layout ici, qui inclura ensuite le template spécifié
        require 'templates/layout.phtml';
    }

    // Vous pouvez ajouter d'autres méthodes ici pour gérer d'autres fonctionnalités liées aux services
}
