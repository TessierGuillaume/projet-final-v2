<?php

class UserController extends AbstractController
{
    private UserManager $manager;

    public function __construct()
    {
        $this->manager = new UserManager();
    }

    public function register(): void
    {
        if (isset($_POST["form-name"]) && $_POST["form-name"] === "register") {
            $roleManager = new RoleManager(); // Créez une instance de RoleManager
            $userRole = $roleManager->getRoleByName("user"); // Récupérez le rôle "user"

            if ($userRole) {
                if (isset($_POST["register-email"], $_POST["register-lastName"], $_POST["register-firstName"], $_POST["register-password"], $_POST["register-confirm-password"])) {
                    if ($this->manager->getUserByEmail($_POST["register-email"]) === null) {
                        if ($_POST["register-password"] === $_POST["register-confirm-password"]) {
                            $password = password_hash($_POST["register-password"], PASSWORD_BCRYPT);
                            $email = htmlspecialchars($_POST["register-email"]);
                            $Last_name = htmlspecialchars($_POST["register-lastName"]);
                            $First_name = htmlspecialchars($_POST["register-firstName"]);

                            // Utilisez le rôle "user" lors de la création du nouvel utilisateur
                            $user = $this->manager->createUser(new User($email, $password, $Last_name, $First_name, $userRole));

                            if ($user) { // Vérification si l'utilisateur a été créé avec succès
                                $_SESSION["user_id"] = $user->getId();
                                $this->render("public/register/register.phtml", ["registered" => true]);
                                return; // Important: Arrêter l'exécution ici
                            }
                        } else {
                            $this->render("public/register/register.phtml", ["errors" => ["les mots de passe ne correspondent pas"]]);
                        }
                    } else {
                        $this->render("public/register/register.phtml", ["errors" => ["un utilisateur avec cet email existe déjà"]]);
                    }
                } else {
                    $this->render("public/register/register.phtml", ["errors" => ["Tous les champs sont requis"]]);
                }
            } else {
                // Gérer le cas où le rôle "user" n'est pas trouvé
                $this->render("public/register/register.phtml", ["errors" => ["Le rôle 'user' n'a pas été trouvé."]]);
            }
        } else {
            $this->render("public/register/register.phtml", []);
        }
    }


   public function login(): void
{
    if (isset($_POST["form-name"]) && $_POST["form-name"] === "login") {
        $email = htmlspecialchars($_POST["login-email"]);
        $password = $_POST["login-password"];

        $user = $this->manager->getUserByEmail($email);

        if ($user !== null) {
            if (password_verify($password, $user->getPassword())) {
                $_SESSION["user_id"] = $user->getId();
                $_SESSION["role"] = $user->getRole()->getRoleName();

                if ($user->getRole()->getRoleName() === 'admin') {
                    header("Location: /projet-final-v2/dashboard");
                } else {
                    header("Location: /projet-final-v2/accueil");  // Redirige vers la page d'accueil
                }
                exit(); // Important pour arrêter l'exécution du script
            } else {
                $this->render("public/login/login.phtml", ["errors" => ["Identifiants incorrects"]]);
            }
        } else {
            $this->render("public/login/login.phtml", ["errors" => ["Aucun compte avec cet email"]]);
        }
    } else {
        $this->render("public/login/login.phtml", []);
    }
}



    private function renderUserHeader(): void
    {
        // Assurez-vous que le chemin vers le fichier header_user.phtml est correct
        require 'templates/partials/header_user.phtml';
    }

    public function manageUsers(): void
    {
        $users = $this->manager->getAllUsers();
        $this->render("admin/users.phtml", ["users" => $users]);
    }
   public function updateUserProfile()
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: /projet-final-v2/login');
        exit();
    }

    $userId = $_SESSION['user_id']; // ID de l'utilisateur connecté

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $firstName = htmlspecialchars($_POST['first_name']);
        $lastName = htmlspecialchars($_POST['last_name']);

        // Récupérez l'utilisateur actuel (y compris le rôle, si nécessaire)
        $user = $this->manager->getUserById($userId);
        
        // Mettez à jour les informations de l'utilisateur
        $user->setEmail($email);
        $user->setFirst_name($firstName);
        $user->setLast_name($lastName);

        // Mettez à jour l'utilisateur dans la base de données
        $updated = $this->manager->updateUser($user);

        if ($updated) { 
            $_SESSION['message'] = 'Votre profil a été mis à jour avec succès.';
        } else {
            $_SESSION['message'] = 'Une erreur est survenue lors de la mise à jour du profil.';
        }

        header('Location: /projet-final-v2/update_profile');
        exit();
    } else {
        $user = $this->manager->getUserById($userId);
        $this->render('public/users/profile_user.phtml', ['user' => $user]);
    }
}




    public function logout(): void
    {
        session_destroy();
        header("Location:/projet-final-v2/homepage");
    }
}
