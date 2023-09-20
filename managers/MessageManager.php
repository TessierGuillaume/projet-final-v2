<?php

class MessageManager extends AbstractManager
{
    // Récupère tous les messages
public function getAllMessages(): array
{
    // Récupérez le rôle de l'utilisateur à partir de la session
    $role = $_SESSION['role'];

    
    $columns = "
        message.Message_ID, 
        user.First_name, 
        user.Last_name,
        message.Subject, 
        message.Message_body, 
        message.Message_datetime
        
    ";

    // Si l'utilisateur est un admin, récupérez tous les messages
    if ($role == 'admin') {
        $query = $this->db->prepare("SELECT $columns FROM message JOIN user ON message.User_ID = user.User_ID");
    } else {
        // Sinon, récupérez uniquement les messages de cet utilisateur
        $userId = $_SESSION['user_id'];
        $query = $this->db->prepare("SELECT $columns FROM message JOIN user ON message.User_ID = user.User_ID WHERE message.User_ID = :userId");
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
    }

    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

    // Récupère un message par son ID
    public function getMessageById($id)
    {
        $sql = "SELECT * FROM message WHERE Message_ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crée un nouveau message
   public function createMessage($user_id, $subject, $message_body)
{
    $sql = "INSERT INTO message (User_ID, Subject, Message_body, Message_datetime) VALUES (:user_id, :subject, :message_body, NOW())";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
    $stmt->bindParam(':message_body', $message_body, PDO::PARAM_STR);
    $stmt->execute();

    // Retourner l'ID du message nouvellement créé
    return $this->db->lastInsertId();
}
    // Met à jour un message existant
    public function updateMessage($id, $subject, $message_body)
    {
        // Récupérer le message actuel
        $message = $this->getMessageById($id);

        // Vérifier que l'utilisateur actuel est le propriétaire du message
        if ($message['User_ID'] == $_SESSION['user_id'] || $_SESSION['role'] == 'admin') {
            $sql = "UPDATE message SET Subject = :subject, Message_body = :message_body WHERE Message_ID = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
            $stmt->bindParam(':message_body', $message_body, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } else {
            // Retourner une erreur si l'utilisateur n'est pas autorisé
            throw new Exception("Vous n'êtes pas autorisé à modifier ce message.");
        }
    }


    // Supprime un message
    public function deleteMessage($id)
    {
        $sql = "DELETE FROM message WHERE Message_ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
 public function searchMessages(string $search): array
{
    $search = "%$search%";
    $stmt = $this->db->prepare("
        SELECT 
            message.Message_ID, 
            message.User_ID, 
            message.Subject, 
            message.Message_body, 
            message.Message_datetime, 
            user.First_name, 
            user.Last_name 
        FROM message 
        JOIN user ON message.User_ID = user.User_ID 
        WHERE message.Subject LIKE ? 
        OR message.Message_body LIKE ? 
        OR user.First_name LIKE ? 
        OR user.Last_name LIKE ?
    ");
    $stmt->execute([$search, $search, $search, $search]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function uploadFiles($message_id, $uploads, $user_id)
{
    foreach ($uploads as $file) {
        // Obtenez le nom du fichier à partir de $_FILES
        $nom_fichier = $file['nom_fichier'];
        
        // Construisez le chemin d'accès complet pour déplacer le fichier
        $chemin_d_acces = 'assets/images/uploads/' . basename($nom_fichier);
        
        // Déplacez le fichier téléchargé vers le répertoire de destination
        if (!move_uploaded_file($file['tmp_name'], $chemin_d_acces)) {
            throw new Exception('Failed to move uploaded file.');
        }
        
        // Préparez et exécutez la requête SQL pour insérer les détails du fichier dans la base de données
        $sql = "INSERT INTO uploads (nom_fichier, chemin_d_acces, taille, date_upload, User_ID, type_fichier, Message_ID) VALUES (:nom_fichier, :chemin_d_acces, :taille, NOW(), :User_ID, :type_fichier, :Message_ID)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':nom_fichier', $nom_fichier, PDO::PARAM_STR);
        $stmt->bindParam(':chemin_d_acces', $chemin_d_acces, PDO::PARAM_STR);
        $stmt->bindParam(':taille', $file['taille'], PDO::PARAM_INT); // Utilisez 'size' au lieu de 'taille'
        $stmt->bindParam(':User_ID', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':type_fichier', $file['type_fichier'], PDO::PARAM_STR); // Utilisez 'type' au lieu de 'type_fichier'
        $stmt->bindParam(':Message_ID', $message_id, PDO::PARAM_INT);

        $stmt->execute();
    }
}

public function getMessageWithUploads($messageId)
{
    $stmt = $this->db->prepare("SELECT * FROM uploads WHERE Message_ID = :Message_ID");
    $stmt->bindValue(':Message_ID', $messageId, PDO::PARAM_INT);
    
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($results as &$upload) {
        $upload['chemin_d_acces'] = 'assets/images/uploads/' . basename($upload['chemin_d_acces']);
    }
   
    return $results;
}

}
