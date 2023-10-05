<?php
class Vehicle
{
    private ?int $idVehicle;
    private string $typeDeVehicle;

    public function __construct(?int $idVehicle, string $typeDeVehicle)
    {
        $this->idVehicle = $idVehicle;
        $this->typeDeVehicle = $typeDeVehicle;
    }
    public function getIdVehicle(): ?int
    {
        return $this->idVehicle;
    }
    public function setIdVehicle(int $idVehicle): void
    {
        $this->idVehicle = $idVehicle;
    }

    public function getTypeDeVehicle(): string
    {
        return $this->typeDeVehicle;
    }
    public function setTypeDeVehicle(string $typeDeVehicle): void
    {
        $this->typeDeVehicle = $typeDeVehicle;
    }
    
}
