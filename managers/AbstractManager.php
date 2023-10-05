<?php


/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */
abstract class AbstractManager
{
    protected PDO $db;



  function __construct()
    {        // Récupère les informations de la base de données

        $dbInfo = $this->getDatabaseInfo();
// Construction de la chaîne de connexion
        $connexion =
            "mysql:host=" .
            $dbInfo["host"] .
            ";port=3306;charset=utf8;dbname=" .
            $dbInfo["db_name"];
        // Initialisation de la connexion à la base de données
        $this->db = new PDO($connexion, $dbInfo["user"], $dbInfo["password"]);
    }
    // Méthode pour obtenir les informations de la base de données

    protected function getDatabaseInfo(): array
    {
        $handle = fopen("config/database.txt", "r");
        $lineNbr = 0;
        $info = [];

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
// Stocke les informations dans le tableau $info en fonction du numéro de ligne
                 if ($lineNbr === 0) {
                    $info["user"] = trim($line);
                } elseif ($lineNbr === 1) {
                    $info["password"] = trim($line);
                } elseif ($lineNbr === 2) {
                    $info["host"] = trim($line);
                } elseif ($lineNbr === 3) {
                    $info["db_name"] = trim($line);
                }

                $lineNbr++;// Incrémente le numéro de ligne
            }

            fclose($handle);// Ferme le fichier
        }
 // Retourne le tableau d'informations
        return $info;
    }
}
