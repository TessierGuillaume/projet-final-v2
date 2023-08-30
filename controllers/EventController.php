<?php
class EventController extends AbstractController
{
    private $eventManager;

    public function __construct()
    {
        $this->eventManager = new EventManager();
    }

    public function eventIndex()
    {
        $events = $this->eventManager->getAllEvents();

        header('Content-Type: application/json'); // Ajout de l'en-tête pour le contenu JSON
        echo json_encode($events);
    }
    public function listEvents()
    {
        $events = $this->eventManager->getAllEvents(); // Utilisation de la propriété $eventManager
        $this->render('public/calendar/calendar.phtml', ['events' => $events]);
    }

    public function viewEvent(int $eventId)
    {
        $event = $this->eventManager->getEventById($eventId); // Utilisation de la propriété $eventManager

        if ($event) {
            $this->render('public/calendar/calendar.phtml', ['event' => $event]);
        } else {
            // Gérer le cas où l'événement n'est pas trouvé
        }
    }

    public function createEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données POST
            $startIso8601 = $_POST['start'];
            $endIso8601 = $_POST['end'];
            $title = $_POST['title'];
            $description = $_POST['description'];

            // Convertir les dates et heures au format compatible avec la base de données
            $startDateTime = new DateTime($startIso8601);
            $endDateTime = new DateTime($endIso8601);

            $formattedStart = $startDateTime->format('Y-m-d H:i:s');
            $formattedEnd = $endDateTime->format('Y-m-d H:i:s');

            // Valider les données (assurez-vous qu'elles sont non nulles, au bon format, etc.)
            if (empty($title) || empty($formattedStart) || empty($formattedEnd)) {
                echo json_encode(['status' => 0, 'error' => 'Les données sont incomplètes']);
                exit;
            }

            // Utiliser directement l'array $eventData
            $eventData = [
                'User_ID' => $_SESSION["user_id"],
                'title' => $title,
                'ID_Vehicule' => null,
                'url' => null,
                'description' => $description,
                'start' => $formattedStart,
                'end' => $formattedEnd,
            ];

            $result = $this->eventManager->createEvent($eventData);

            if ($result) {
                echo json_encode(['status' => 1, 'message' => 'Événement ajouté avec succès!', 'event' => $eventData]);
            } else {
                echo json_encode(['status' => 0, 'error' => 'Erreur lors de la création de l\'événement']);
            }
        }
    }
    public function deleteEvent(int $eventId)
    {
        // Supprimer l'événement de la base de données en utilisant votre méthode deleteEventById
        $success = $this->eventManager->deleteEventById($eventId);

        if ($success) {
            // Récupérer la liste mise à jour des événements depuis la base de données
            $updatedEvents = $this->eventManager->getAllEvents();

            // Renvoyer la liste des événements mise à jour sous forme de réponse JSON
            header('Content-Type: application/json');
            echo json_encode($updatedEvents);
            exit;
        } else {
            // En cas d'erreur lors de la suppression, renvoyer une réponse d'erreur JSON
            header('Content-Type: application/json');
            echo json_encode(['status' => 0, 'error' => 'Erreur lors de la suppression de l\'événement']);
            exit;
        }
    }
    public function getEvents()
    {
        $events = [];

        // Horaires d'ouverture et de fermeture
        $openingTime = new DateTime('08:00:00');
        $closingTime = new DateTime('18:00:00');

        // Date de début (aujourd'hui) et date de fin (7 jours plus tard)
        $startDate = new DateTime();
        $endDate = clone $startDate;
        $endDate->modify('+7 days');

        // Génération des créneaux horaires disponibles
        $currentTime = clone $startDate;
        while ($currentTime <= $endDate) {
            if ($currentTime->format('N') >= 1 && $currentTime->format('N') <= 5) { // Lundi à vendredi
                $time = clone $currentTime;
                $time->setTime($openingTime->format('H'), $openingTime->format('i')); // Définir l'heure d'ouverture
                while ($time <= $closingTime) {
                    $events[] = [
                        'title' => 'Contrôle technique',
                        'start' => $time->format('Y-m-d H:i:s'),
                        'end' => $time->modify('+30 minutes')->format('Y-m-d H:i:s')
                    ];
                    $time->modify('+15 minutes');
                }
            }
            $currentTime->modify('+1 day');
        }
        return $this->render('public/calendar/calendar.phtml', ['events' => $events]);
    }
    public function getEventsIndexForUser()
    {
        $events = $this->eventManager->getAllEvents();

        header('Content-Type: application/json'); // Ajout de l'en-tête pour le contenu JSON
        echo json_encode($events);
    }
    public function getEventsUser()
    {
        $events = [];

        // Horaires d'ouverture et de fermeture
        $openingTime = new DateTime('08:00:00');
        $closingTime = new DateTime('18:00:00');

        // Date de début (aujourd'hui) et date de fin (7 jours plus tard)
        $startDate = new DateTime();
        $endDate = clone $startDate;
        $endDate->modify('+7 days');

        // Génération des créneaux horaires disponibles
        $currentTime = clone $startDate;
        while ($currentTime <= $endDate) {
            if ($currentTime->format('N') >= 1 && $currentTime->format('N') <= 5) { // Lundi à vendredi
                $time = clone $currentTime;
                $time->setTime($openingTime->format('H'), $openingTime->format('i')); // Définir l'heure d'ouverture
                while ($time <= $closingTime) {
                    $events[] = [
                        'title' => 'Contrôle technique',
                        'start' => $time->format('Y-m-d H:i:s'),
                        'end' => $time->modify('+30 minutes')->format('Y-m-d H:i:s')
                    ];
                    $time->modify('+15 minutes');
                }
            }
            $currentTime->modify('+1 day');
        }
        return $this->render('public/calendar/calendar_user.phtml', ['events' => $events]);
    }
    public function createEventUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données POST
            $startIso8601 = $_POST['start'];
            $endIso8601 = $_POST['end'];
            $title = $_POST['title'];
            $description = null;

            // Convertir les dates et heures au format compatible avec la base de données
            $startDateTime = new DateTime($startIso8601);
            $endDateTime = new DateTime($endIso8601);

            $formattedStart = $startDateTime->format('Y-m-d H:i:s');
            $formattedEnd = $endDateTime->format('Y-m-d H:i:s');

            // Valider les données (assurez-vous qu'elles sont non nulles, au bon format, etc.)
            if (empty($title) || empty($formattedStart) || empty($formattedEnd)) {
                echo json_encode(['status' => 0, 'error' => 'Les données sont incomplètes']);
                exit;
            }

            // Utiliser directement l'array $eventData
            $eventData = [
                'User_ID' => $_SESSION["user_id"],
                'title' => $title,
                'ID_Vehicule' => null,
                'url' => null,
                'description' => $description,
                'start' => $formattedStart,
                'end' => $formattedEnd,
            ];

            $result = $this->eventManager->createEventUser($eventData);

            if ($result) {
                echo json_encode(['status' => 1, 'message' => 'Événement ajouté avec succès!', 'event' => $eventData]);
            } else {
                echo json_encode(['status' => 0, 'error' => 'Erreur lors de la création de l\'événement']);
            }
        }
    }
}
