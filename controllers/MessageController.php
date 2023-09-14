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
        $this->render("admin/view_message.phtml", ['message' => $message]);
    }

    public function create()
    {
        if (isset($_POST["form-name"]) && $_POST["form-name"] === "create-message") {
            $user_id = $_SESSION['user_id']; // Assurez-vous que l'ID utilisateur est stocké dans la session
            $subject = htmlspecialchars($_POST['subject']);
            $message_body = htmlspecialchars($_POST['message_body']);

            $this->messageManager->createMessage($user_id, $subject, $message_body);
            $_SESSION['confirmation_message'] = "Votre message a été créé avec succès. Merci !";

        }
        $this->render('admin/create_message.phtml');
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
        $this->messageManager->deleteMessage($id);
        header('Location: /projet-final-v2/delete_message');
        exit();
    }

    public function manageMessages(): void
    {
        $messages = $this->messageManager->getAllMessages();
        $this->render("admin/messages.phtml", ["messages" => $messages]);
    }
}
