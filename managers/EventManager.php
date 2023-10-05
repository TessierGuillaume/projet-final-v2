<?php
class EventManager extends AbstractManager
{
    public function getAllEvents(): array
    {
        // Méthode pour récupérer tous les événements
        $stmt = $this->db->prepare('SELECT * FROM events');
        $stmt->execute();
        // Retourne tous les événements sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Méthode pour récupérer un événement par son ID
    public function getEventById(int $id): ?Event
    {
        $stmt = $this->db->prepare('SELECT * FROM events WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
        return $stmt->fetch() ?: null;
    }
        // Méthode pour créer un nouvel événement
    public function createEvent(array $eventData): bool
    {
        $stmt = $this->db->prepare('INSERT INTO events (User_ID, ID_Vehicule, title, description, url, start, end) VALUES (:User_ID, :ID_Vehicule, :title, :description, :url, :start, :end)');
        return $stmt->execute([
            'User_ID' =>  $eventData['User_ID'],
            'ID_Vehicule' => $eventData['ID_Vehicule'],
            'title' => $eventData['title'],
            'description' => $eventData['description'],
            'url' => $eventData['url'],
            'start' => $eventData['start'],
            'end' => $eventData['end']


        ]);
    }
    // Méthode pour créer un événement pour un utilisateur spécifique
    public function createEventUser(array $eventData): bool
    {
        $stmt = $this->db->prepare('INSERT INTO events (User_ID, ID_Vehicule, title, description, url, start, end) VALUES (:User_ID, :ID_Vehicule, :title, :description, :url, :start, :end)');
        return $stmt->execute([
            'User_ID' =>  $eventData['User_ID'],
            'ID_Vehicule' => $eventData['ID_Vehicule'],
            'title' => $eventData['title'],
            'description' => $eventData['description'],
            'url' => $eventData['url'],
            'start' => $eventData['start'],
            'end' => $eventData['end']


        ]);
    }
    // Méthode pour supprimer un événement par son ID
    public function deleteEventById(int $eventId): bool
    {
        $stmt = $this->db->prepare('DELETE FROM events WHERE id = :eventId');
        $success = $stmt->execute(['eventId' => $eventId]);

        return $success;
    }

}