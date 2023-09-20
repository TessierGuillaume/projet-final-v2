<?php
class MessageController extends AbstractController
{
    private $messageManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
    }

    public function index()
    {
        $messages = $this->messageManager->getAllMessages();
        $this->render('admin/index_message.phtml', ['messages' => $messages]);
    }

    public function viewMessage($id)
    {
        $message = $this->messageManager->getMessageById($id);
        $uploads = $this->messageManager->getMessageWithUploads($id);
        $this->render("admin/view_message.phtml", ['message' => $message, 'uploads' => $uploads]);
    }
    
    
    
    
public function create()
{
    
        if (isset($_POST["form-name"]) && $_POST["form-name"] === "create-message") {
        if(isset($_SESSION['user_id'])){ // Vérification supplémentaire pour éviter les erreurs
            $user_id = $_SESSION['user_id']; 
        } else {
            // Redirection ou message d'erreur si l'ID de l'utilisateur n'est pas trouvé dans la session
            header('Location:/projet-final-v2/connexion');
            exit();
        }
        $subject = htmlspecialchars($_POST['subject']);
        $message_body = htmlspecialchars($_POST['message_body']);

        // Création du message et récupération de son ID
        $message_id = $this->messageManager->createMessage($user_id, $subject, $message_body);

        // Traitement et upload des fichiers
        if (!empty($_FILES['fichiers']['name'][0])) {
            $uploads = $this->getUploadedFilesDetails($_FILES['fichiers']);
            $this->messageManager->uploadFiles($message_id, $uploads, $user_id);
        }

        $_SESSION['confirmation_message'] = "Votre message a été créé avec succès. Merci !";
    }
    $this->render('admin/create_message.phtml');
}

 private function getUploadedFilesDetails($files) {
        $uploads = [];

        foreach ($files['name'] as $key => $name) {
            if ($files['error'][$key] === UPLOAD_ERR_OK) {
                $uploads[] = [
                    'nom_fichier' => $name,
                    'chemin_d_acces' => 'assets/images/uploads/' . $name, 
                    'tmp_name' => $files['tmp_name'][$key], 
                    'taille' => $files['size'][$key], 
                    'type_fichier' => $files['type'][$key],
                    'date_upload' => date('Y-m-d H:i:s'), // Ajout de la date et de l'heure actuelles
                ];
            }
        }

        return $uploads;
    }



    public function store()
    {
         header('Location: /projet-final-v2/create_message'); // Rediriger vers la page de création de message
    exit();
    }

    public function edit($id)
    {
        $message = $this->messageManager->getMessageById($id);
        $this->render("admin/edit_message.phtml", ['message' => $message]);
    }

    public function update($id)
    {
        if (isset($_POST['subject']) && isset($_POST['message_body'])) {
            $subject = htmlspecialchars($_POST['subject']);
            $message_body = htmlspecialchars($_POST['message_body']);
            $this->messageManager->updateMessage($id, $subject, $message_body);
            header("Location: /projet-final-v2/messages");
        } else {
            // Vous pouvez rediriger vers une page d'erreur ou afficher un message d'erreur ici
            echo "Les données nécessaires pour la mise à jour sont manquantes.";
        }
        exit();
    }


public function deleteMessage($id)
{
    $result = $this->messageManager->deleteMessage($id);
    if ($result) {
        $_SESSION['success_message'] = "Le message a été supprimé avec succès.";
        header('Location: /projet-final-v2/messages');
    } else {
        $_SESSION['error_message'] = "Échec de la suppression du message.";
        header('Location: /projet-final-v2/messages');
    }
    exit();
}


    public function manageMessages(): void
    {
        $messages = $this->messageManager->getAllMessages();
        $this->render("admin/messages.phtml", ["messages" => $messages]);
    }
}
