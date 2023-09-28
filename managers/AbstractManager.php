<?php
abstract class AbstractManager
{
    protected PDO $db;



    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=db.3wa.io;dbname=guillaumetessier_ControleTechnique;charset=utf8", "guillaumetessier", "1b75c35a36371d17570d1a25e38cb2af");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Gérer l'erreur de connexion
            die("Erreur de connexion: " . $e->getMessage());
        }
    }
}
