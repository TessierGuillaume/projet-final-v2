<?php
class RoleManager extends AbstractManager
{
    public function getRoleById(int $roleId): ?Role
    {
        $query = $this->db->prepare('SELECT * FROM role WHERE Role_ID = :id');
        $query->execute(['id' => $roleId]);
        $roleData = $query->fetch();

        if ($roleData) {
            return new Role((int)$roleData['Role_ID'], $roleData['Role_Name']);
        }

        return null;
    }
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
    // Autres méthodes ici...
}
