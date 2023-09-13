<?php
class User
{
    private ?int $id;
    private string $email;
    private string $password;
    private string $last_name;
    private string $first_name;
    private Role $role;

    public function __construct(
        string $email,
        string $password,
        string $last_name,
        string $first_name,
        Role $role
    ) {
        $this->id = null;
        $this->email = $email;
        $this->password = $password;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->role = $role;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getLast_name(): string
    {
        return $this->last_name;
    }
    public function getFirst_name(): string
    {
        return $this->first_name;
    }
    public function getRole(): Role // Ajout de la méthode getRole
    {
        return $this->role;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setLast_name(string $last_name): void
    {
        $this->last_name = $last_name;
    }
    public function setFirst_name(string $first_name): void
    {
        $this->first_name = $first_name;
    }
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }
}
