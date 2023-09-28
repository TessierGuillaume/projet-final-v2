<?php
class EventManager extends AbstractManager
{
    public function getAllEvents(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM events');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEventById(int $id): ?Event
    {
        $stmt = $this->db->prepare('SELECT * FROM events WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
        return $stmt->fetch() ?: null;
    }

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

    public function deleteEventById(int $eventId): bool
    {
        $stmt = $this->db->prepare('DELETE FROM events WHERE id = :eventId');
        $success = $stmt->execute(['eventId' => $eventId]);

        return $success;
    }


    // Ajoutez d'autres méthodes selon vos besoins (par exemple, pour éditer ou supprimer un événement)
}