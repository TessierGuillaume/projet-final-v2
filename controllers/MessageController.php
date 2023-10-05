<?php
class MessageController extends AbstractController
{
    private $messageManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
    }
 // Méthode pour afficher tous les messages
    public function index()
    {
        $messages = $this->messageManager->getAllMessages();
        $this->render('admin/index_message.phtml', ['messages' => $messages]);
    }
 // Méthode pour afficher un message spécifique
    public function viewMessage($id)
    {
        $message = $this->messageManager->getMessageById($id);
        $uploads = $this->messageManager->getMessageWithUploads($id);
        $this->render("admin/view_message.phtml", ['message' => $message, 'uploads' => $uploads]);
    }
    
    
    
     // Méthode pour créer un nouveau message
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
 // Méthode pour obtenir les détails des fichiers téléchargés
    private function getUploadedFilesDetails($files) {
    $uploads = [];  

    // Taille maximale du fichier en octets 2mb
    $maxFileSize = 2 * 1024 * 1024;

    // Parcourir tous les fichiers téléchargés
    foreach ($files['name'] as $key => $name) {
        // Vérifier si le téléchargement du fichier s'est bien passé
        if ($files['error'][$key] === UPLOAD_ERR_OK) {
            
            // Vérifier la taille du fichier
            if ($files['size'][$key] > $maxFileSize) {
                 $_SESSION['error_message'] = "Le fichier $name est trop gros.";
            header('Location: /projet-final-v2/create_message');
            exit();
            }

            
            $uploads[] = [
                'nom_fichier' => $name,  
                'chemin_d_acces' => 'assets/images/uploads/' . $name,  
                'tmp_name' => $files['tmp_name'][$key],  
                'taille' => $files['size'][$key], 
                'type_fichier' => $files['type'][$key], 
                'date_upload' => date('Y-m-d H:i:s'),  
            ];
        }
    }

    return $uploads;  
}

    // Méthode pour rediriger vers la page de création de message

    public function store()
    {
         header('Location: /projet-final-v2/create_message');
    exit();
    }
    
    // Méthode pour afficher le formulaire de modification de message

    public function edit($id)
    {
        $message = $this->messageManager->getMessageById($id);
        $this->render("admin/edit_message.phtml", ['message' => $message]);
    }
    // Méthode pour mettre à jour un message

    public function update($id)
    {
        if (isset($_POST['subject']) && isset($_POST['message_body'])) {
            $subject = htmlspecialchars($_POST['subject']);
            $message_body = htmlspecialchars($_POST['message_body']);
            $this->messageManager->updateMessage($id, $subject, $message_body);
            header("Location: /projet-final-v2/messages");
        } else {
           
            echo "Les données nécessaires pour la mise à jour sont manquantes.";
        }
        exit();
    }

// Méthode pour supprimer un message
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

    // Méthode pour gérer tous les messages (côté administrateur)

    public function manageMessages(): void
    {
        $messages = $this->messageManager->getAllMessages();
        $this->render("admin/messages.phtml", ["messages" => $messages]);
    }
}
