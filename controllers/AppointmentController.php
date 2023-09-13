<?php

class AppointmentController extends AbstractController
{
    private AppointmentManager $appointmentManager;

    public function __construct()
    {
        $this->appointmentManager = new AppointmentManager();
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer l'ID de l'utilisateur à partir de la session
            $userId = $_SESSION['user_id'];

            // Récupérer le choix du service de l'utilisateur
            $serviceChoice = htmlspecialchars($_POST['service_choice']);

            // Déterminer l'ID du service en fonction du choix de l'utilisateur
            $serviceId = $serviceChoice == 1 ? 1 : 2; // 1 pour contrôle technique, 2 pour contre-visite

            // Récupérer la date et l'heure du rendez-vous
            $appointmentDate = htmlspecialchars($_POST['appointmentDate']);
            $appointmentTime = htmlspecialchars($_POST['appointmentTime']);
            $appointmentDatetime = $appointmentDate . ' ' . $appointmentTime;

            // Créer le rendez-vous
            $appointment = new Appointment(null, $userId, $serviceId, $appointmentDatetime);
            $this->appointmentManager->create($appointment);
            $_SESSION['appointment_datetime'] = $appointment->getAppointmentDatetime();

            // Rediriger vers la page de succès ou la liste des rendez-vous
            header('Location: index.php?route=thank_you');
            exit();
        }

        // Afficher le formulaire de création
        $this->render('public/appointments/create.phtml');
    }




    public function edit($appointmentId)
    {
        $appointment = $this->appointmentManager->find($appointmentId);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = htmlspecialchars($_POST['userId']);
            $serviceId = htmlspecialchars($_POST['serviceId']);
            $appointmentDatetime = htmlspecialchars($_POST['appointmentDatetime']);
            $appointment->setUserId($userId);
            $appointment->setServiceId($serviceId);
            $appointment->setAppointmentDatetime($appointmentDatetime);
            $this->appointmentManager->update($appointment);
            // Rediriger vers une page de succès ou la liste des rendez-vous
        }
        // Afficher le formulaire d'édition
    }

    public function delete($appointmentId)
    {
        $this->appointmentManager->delete($appointmentId);
        // Rediriger vers la liste des rendez-vous
    }

    public function show($appointmentId)
    {
        $appointment = $this->appointmentManager->find($appointmentId);
        // Afficher la vue du rendez-vous
    }

    public function store()
    {
        // Vérifie si les données du formulaire sont présentes
        if (isset($_POST['date']) && isset($_POST['time'])) {
            // Récupère et nettoie les données du formulaire
            $date = htmlspecialchars($_POST['date']);
            $time = htmlspecialchars($_POST['time']);
            // ... autres champs ...

            // Crée un nouveau rendez-vous avec ces données
            $appointmentManager = new AppointmentManager();
            $appointmentManager->create($date, $time /*, autres paramètres */);

            // Redirige vers la liste des rendez-vous ou une autre page
            header('Location: index.php?route=index_appointment');
        } else {
            // Gère l'erreur, par exemple en redirigeant vers le formulaire avec un message d'erreur
            header('Location: index.php?route=create_appointment&error=missing_data');
        }
    }

    public function index()
    {
        $appointments = $this->appointmentManager->findAll();
        $this->render('public/appointments/index.phtml', ['appointments' => $appointments]);
        // Afficher la vue de la liste des rendez-vous
    }

    public function thankYou()
    {
        $appointmentDatetime = $_SESSION['appointment_datetime'];
        $dateTime = new DateTime($appointmentDatetime); // Création d'un objet DateTime
        $formattedDatetime = $dateTime->format('d-m-Y H:i'); // Formatage de la date et de l'heure
        $this->render('public/appointments/thank_you.phtml', ['appointmentDatetime' => $formattedDatetime]);
    }
}
