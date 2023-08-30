<?php

class AdminController extends AbstractController
{
    private $userManager;
    private $messageManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->messageManager = new MessageManager();
    }

    // Fonction pour afficher le tableau de bord administratif
    public function dashboard()
    {
        // Vous pouvez ajouter des statistiques ou des informations pertinentes ici
        $this->render('admin/dashboard.phtml');
    }

    // Fonction pour gérer les utilisateurs
    public function manageUsers()
    {
        $users = $this->userManager->getAllUsers();
        $this->render('admin/users.phtml', ['users' => $users]);
    }

    // Fonction pour gérer les messages
    public function manageMessages()
    {
        $messages = $this->messageManager->getAllMessages();
        $this->render('admin/messages.phtml', ['messages' => $messages]);
    }

    // Fonction pour modifier un utilisateur (comme exemple)
    public function editUser($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']);
            $firstName = htmlspecialchars($_POST['first_name']);
            $lastName = htmlspecialchars($_POST['last_name']);
            $roleName = htmlspecialchars($_POST['role']);

            // Obtenez l'objet de rôle à partir du nom
            $roleManager = new RoleManager();
            $role = $roleManager->getRoleByName($roleName);

            // Créez un objet utilisateur
            $user = new User($email, '', $lastName, $firstName, $role);
            $user->setId($id);

            // Mettez à jour l'utilisateur
            $this->userManager->updateUser($user);

            header('Location: index.php?route=dashboard');
            exit();
        } else {
            $user = $this->userManager->getUserById($id);
            $this->render('admin/edit_user.phtml', ['user' => $user]); // Assurez-vous que le fichier de template s'appelle "edit_user.phtml"
        }
    }


    public function deleteUser(int $userId): void
    {
        $this->userManager->deleteUser($userId);
        header('Location: index.php?route=admin/users');
        exit();
    }

    // Fonction pour supprimer un message
    public function deleteMessage($id)
    {
        $this->messageManager->deleteMessage($id);
        header('Location: index.php?route=messages');
        exit();
    }
    public function updateUser(int $userId): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']);
            $firstName = htmlspecialchars($_POST['first_name']);
            $lastName = htmlspecialchars($_POST['last_name']);
            $roleName = htmlspecialchars($_POST['role']);

            // Obtenez l'objet de rôle à partir du nom
            $roleManager = new RoleManager();
            $role = $roleManager->getRoleByName($roleName);

            $user = new User($email, '', $lastName, $firstName, $role); // Le mot de passe peut être laissé vide ici
            $user->setId($userId);

            $this->userManager->updateUser($user);

            header('Location: index.php?route=admin/edit_user');
            exit();
        } else {
            $this->editUser($userId); // Redirige vers le formulaire d'édition si la méthode n'est pas POST
        }
    }
}
