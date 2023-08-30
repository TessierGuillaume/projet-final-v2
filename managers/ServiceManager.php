<?php

class ServiceManager extends AbstractManager
{



    public function getAllServices()
    {
        // Écrire la requête SQL pour récupérer tous les services
        $sql = "SELECT * FROM Services";

        // Préparer la requête
        $stmt = $this->pdo->prepare($sql);

        // Exécuter la requête
        $stmt->execute();

        // Récupérer les lignes résultantes sous forme de tableau associatif
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $services;
    }
    public function getTechnicalControlService()
    {
        $query = $this->db->prepare("SELECT * FROM services WHERE service_name = 'Technical Control'");
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return new Service(
            $result['serviceId'],
            $result['serviceName'],
            $result['serviceDescription'],
            $result['serviceCost']
        );
    }

    public function getReinspectionService()
    {
        $query = $this->db->prepare("SELECT * FROM services WHERE service_name = 'Reinspection'");
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return new Service(
            $result['serviceId'],
            $result['serviceName'],
            $result['serviceDescription'],
            $result['serviceCost']
        );
    }
}
