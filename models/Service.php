<?php

class Service
{
    private ?int $Service_ID;
    private string $Service_name;
    private ?string $Service_description;
    private float $Service_cost;
    private ?string $Vehicle_type;

    public function __construct(
        ?int $Service_ID, 
        string $Service_name, 
        ?string $Service_description, 
        float $Service_cost, 
        ?string $Vehicle_type
    ) {
        $this->Service_ID = $Service_ID;
        $this->Service_name = $Service_name;
        $this->Service_description = $Service_description;
        $this->Service_cost = $Service_cost;
        $this->Vehicle_type = $Vehicle_type;
    }

    public function getServiceID(): ?int
    {
        return $this->Service_ID;
    }

    public function setServiceID(?int $Service_ID): void
    {
        $this->Service_ID = $Service_ID;
    }

    public function getServiceName(): string
    {
        return $this->Service_name;
    }

    public function setServiceName(string $Service_name): void
    {
        $this->Service_name = $Service_name;
    }

    public function getServiceDescription(): ?string
    {
        return $this->Service_description;
    }

    public function setServiceDescription(?string $Service_description): void
    {
        $this->Service_description = $Service_description;
    }

    public function getServiceCost(): float
    {
        return $this->Service_cost;
    }

    public function setServiceCost(float $Service_cost): void
    {
        $this->Service_cost = $Service_cost;
    }

    public function getVehicleType(): ?string
    {
        return $this->Vehicle_type;
    }

    public function setVehicleType(?string $Vehicle_type): void
    {
        $this->Vehicle_type = $Vehicle_type;
    }
}
