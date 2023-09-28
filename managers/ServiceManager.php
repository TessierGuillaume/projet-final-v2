<?php

class ServiceManager extends AbstractManager
{
 public function getAllServices()
{
    $sql = 'SELECT * FROM service';
    $query = $this->db->prepare($sql);  
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}
    public function getAllServiceNames() {
    $query = "SELECT Service_name FROM services";
    $result = $this->pdo->query($query)->fetchAll();
    return $result;
}


    public function getServiceByName(array $serviceName) : bool
    {
        $query = $this->db->prepare("SELECT * FROM service WHERE Service_name = :serviceName");
        $query->bindParam(':serviceName', $serviceName);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Service(
                $result['Service_ID'],
                $result['Service_name'],
                $result['Service_description'],
                (float)$result['Service_cost'],
                $result['Vehicle_type']
            );
        }

        return null;
    }
    
    public function updateService($id, $name, $cost, $vehicle_type)
    {
          $sql = "UPDATE service SET Service_name = ?, Service_cost = ?, Vehicle_type = ? WHERE Service_ID = ?";
          $stmt = $this->db->prepare($sql);
          $stmt->execute([$name, $cost, $vehicle_type, $id]);
    }
    
    public function getServiceById($id) {
    $sql = 'SELECT * FROM service WHERE Service_ID = :id';
    $query = $this->db->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}


}
