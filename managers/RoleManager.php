<?php
class RoleManager extends AbstractManager
{
     // Récupère un rôle par son ID
    public function getRoleById(int $roleId): ?Role
    {
        $query = $this->db->prepare('SELECT * FROM role WHERE Role_ID = :id');
        $query->execute(['id' => $roleId]);
        $roleData = $query->fetch();
        // Crée et retourne un objet Role si les données existent
        if ($roleData) {
            return new Role((int)$roleData['Role_ID'], $roleData['Role_Name']);
        }

        return null;
    }
    // Récupère un rôle par son nom
    public function getRoleByName(string $roleName): ?Role
    {
        $query = $this->db->prepare('SELECT * FROM role WHERE Role_Name = :name');
        $query->execute(['name' => $roleName]);
        $roleData = $query->fetch();

        if ($roleData) {
            return new Role((int)$roleData['Role_ID'], $roleData['Role_Name']);
        }

        return null;
    }
    
}
