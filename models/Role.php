<?php
class Role
{
    private ?int $roleId;
    private string $roleName;


    public function __construct(?int $roleId, string $roleName)
    {
        $this->roleId = $roleId;
        $this->roleName = $roleName;
    }
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    public function getRoleName(): string
    {
        return $this->roleName;
    }
    public function setRoleName(string $roleName): void
    {
        $this->roleName = $roleName;
    }
    
}
