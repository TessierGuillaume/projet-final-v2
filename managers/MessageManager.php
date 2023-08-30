<?php

class MessageManager extends AbstractManager
{
    // Récupère tous les messages
    public function getAllMessages(): array
    {
        // Récupérez le rôle de l'utilisateur à partir de la session
        $role = $_SESSION['role'];

        // Si l'utilisateur est un admin, récupérez tous les messages
        if ($role == 'admin') {
            $query = $this->db->prepare("SELECT * FROM message JOIN user ON message.User_ID = user.User_ID");
        } else {
            // Sinon, récupérez uniquement les messages de cet utilisateur
            $userId = $_SESSION['user_id'];
            $query = $this->db->prepare("SELECT * FROM message JOIN user ON message.User_ID = user.User_ID WHERE message.User_ID = :userId");
            $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        }

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
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
        return $stmt->execute();
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
}
