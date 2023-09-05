<?php

class ServiceManager extends AbstractManager
{
    public function getAllServices()
    {
        // Écrire la requête SQL pour récupérer tous les services
        $sql = "SELECT * FROM service";

        // Préparer la requête
        $stmt = $this->db->prepare($sql);

        // Exécuter la requête
        $stmt->execute();

        // Récupérer les lignes résultantes sous forme de tableau associatif
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $services;
    }

    public function getTechnicalControlService()
    {
        $query = $this->db->prepare("SELECT * FROM service WHERE Service_name = 'Technical Control'");
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return new Service(
            $result['Service_Id'],
            $result['Service_Name'],
            $result['Service_Description'],
            $result['Service_Cost']
        );
    }

    public function getReinspectionService()
    {
        $query = $this->db->prepare("SELECT * FROM service WHERE Service_name = 'Reinspection'");
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return new Service(
            $result['Service_Id'],
            $result['Service_Name'],
            $result['Service_Description'],
            $result['Service_Cost']
        );
    }
}
