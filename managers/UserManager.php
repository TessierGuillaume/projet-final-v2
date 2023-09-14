<?php

class UserManager extends AbstractManager
{
    public function getUserById(int $id): ?User
    {
        $query = $this->db->prepare("SELECT u.*, r.Role_Name FROM user u LEFT JOIN role r ON u.Role_ID = r.Role_ID WHERE u.User_ID = :id");
        $parameters = ["id" => $id];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result !== false) {
            $role = new Role($result["Role_ID"], $result["Role_Name"]);
            $user = new User($result["Email"], $result["Password"], $result["Last_name"], $result["First_name"], $role);
            $user->setId($result["User_ID"]);

            return $user;
        }

        return null;
    }

    public function getUserByEmail(string $email): ?User
    {
        $query = $this->db->prepare("SELECT user.*, role.Role_Name FROM user JOIN role ON user.Role_ID = role.Role_ID WHERE user.email = :email");
        $parameters = [
            "email" => $email
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result !== false) {
            $role = new Role($result["Role_ID"], $result["Role_Name"]);
            $user = new User(
                $result["Email"],
                $result["Password"],
                $result["Last_name"],
                $result["First_name"],
                $role
            );
            $user->setId($result["User_ID"]);

            return $user;
        }

        return null;
    }


    public function createUser(User $user): ?User
    {
        $query = $this->db->prepare("INSERT INTO user(Email, Password, Last_name, First_name, Role_ID) VALUES (:email, :password, :Last_name, :First_name, :Role_ID)");
        $parameters = [
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "Last_name" => $user->getLast_name(),
            "First_name" => $user->getFirst_name(),
            "Role_ID" => $user->getRole()->getRoleId(),
        ];

        $query->execute($parameters);

        $user->setId($this->db->lastInsertId());
        return $user;
    }

    public function deleteUser(int $id): void
    {
        // Suppression des messages associés à l'utilisateur
        $query = $this->db->prepare("DELETE FROM message WHERE User_ID = :userId");
        $query->bindParam(':userId', $id, PDO::PARAM_INT);
        $query->execute();

        // Suppression de l'utilisateur
        $query = $this->db->prepare("DELETE FROM user WHERE User_ID = :userId");
        $query->bindParam(':userId', $id, PDO::PARAM_INT);
        $query->execute();
    }

    public function getAllUsers(): array
    {
        $query = $this->db->prepare("SELECT user.*, role.Role_Name FROM user JOIN role ON user.Role_ID = role.Role_ID");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $users = [];

        foreach ($results as $result) {
            $role = new Role($result["Role_ID"], $result["Role_Name"]);
            $user = new User(
                $result["Email"],
                $result["Password"],
                $result["Last_name"],
                $result["First_name"],
                $role
            );
            $user->setId($result["User_ID"]);
            $users[] = $user;
        }

        return $results;
    }

    public function editUser(User $user): bool
    {
        $sql = "UPDATE user SET Email = :email, Last_name = :lastName, First_name = :firstName, Role_ID = :roleId WHERE User_ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $user->getLast_name(), PDO::PARAM_STR);
        $stmt->bindValue(':firstName', $user->getFirst_name(), PDO::PARAM_STR);
        $stmt->bindValue(':roleId', $user->getRole()->getRoleId(), PDO::PARAM_INT);
        $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }
}
