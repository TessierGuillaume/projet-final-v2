<?php
abstract class AbstractManager
{
    protected PDO $db;



    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=drivesafecontrole", "ricard", "-BUqOLY5-.E])Gm/");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Gérer l'erreur de connexion
            die("Erreur de connexion: " . $e->getMessage());
        }
    }
}
