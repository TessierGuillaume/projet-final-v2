<?php
class Service
{
    private ?int $serviceId;
    private string $serviceName;
    private ?string $serviceDescription;
    private float $serviceCost;

    public function __construct(?int $serviceId, string $serviceName, ?string $serviceDescription, float $serviceCost)
    {
        $this->serviceId = $serviceId;
        $this->serviceName = $serviceName;
        $this->serviceDescription = $serviceDescription;
        $this->serviceCost = $serviceCost;
    }
    public function getServiceId(): int
    {
        return $this->serviceId;
    }
    public function setServiceId(int $serviceId): void
    {
        $this->serviceId = $serviceId;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }
    public function setServiceName(string $serviceName): void
    {
        $this->serviceName = $serviceName;
    }

    public function getServiceDescription(): ?string
    {
        return $this->serviceDescription;
    }
    public function setServiceDescription(?string $serviceDescription): void
    {
        $this->serviceDescription = $serviceDescription;
    }

    public function getServiceCost(): float
    {
        return $this->serviceCost;
    }
    public function setServiceCost(float $serviceCost): void
    {
        $this->serviceCost = $serviceCost;
    }
    // Getters et setters ici...
}
