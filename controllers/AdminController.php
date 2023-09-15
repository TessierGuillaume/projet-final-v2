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
       
        $this->render('partials/header_admin.phtml');
    }

    // Fonction pour gérer les utilisateurs
   public function manageUsers()
{
    $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
    
    if ($search !== '') {
        $users = $this->userManager->searchUsers($search);
    } else {
        $users = $this->userManager->getAllUsers();
    }
    
    $this->render('admin/users.phtml', ['users' => $users]);
}

    // Fonction pour gérer les messages
   public function manageMessages()
{
    $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
    
    if ($search !== '') {
        $messages = $this->messageManager->searchMessages($search);
    } else {
        $messages = $this->messageManager->getAllMessages();
    }
    
    $this->render('admin/messages.phtml', ['messages' => $messages]);
}


    // Fonction pour modifier un utilisateur (comme exemple)
 public function editUser(int $id)
{
    $user = $this->userManager->getUserById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $firstName = htmlspecialchars($_POST['first_name']);
        $lastName = htmlspecialchars($_POST['last_name']);
        $roleName = htmlspecialchars($_POST['role']);

        // Obtenez l'objet de rôle à partir du nom
        $roleManager = new RoleManager();
        $role = $roleManager->getRoleByName($roleName);

        $user->setEmail($email);
        $user->setFirst_name($firstName); 
        $user->setLast_name($lastName);   
        $user->setRole($role);

        $this->userManager->editUser($user);

        header('Location: /projet-final-v2/edit_user?id=' . $id);
        exit();
    } else {
        $this->render('admin/edit_user.phtml', ['user' => $user]);
    }
}


    public function deleteUser(int $userId): void
    {
        $this->userManager->deleteUser($userId);
        header('Location: /projet-final-v2/admin/users');
        exit();
    }

    // Fonction pour supprimer un message
    public function deleteMessage($id)
    {
        $this->messageManager->deleteMessage($id);
        header('Location: /projet-final-v2/messages');
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

            header('Location: /projet-final-v2/admin/edit_user');
            exit();
        } else {
            $this->editUser($userId); // Redirige vers le formulaire d'édition si la méthode n'est pas POST
        }
    }
}
