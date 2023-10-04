<?php
class Event
{

    private ?int $id;
    private ?int $userId;
    private ?int $vehicleId;
    private string $title;
    private ?string $description;
    private ?string $url;
    private string $start; 
    private string $end; 
    private ?int $serviceId; 

    public function __construct(?int $id, ?int $userId, ?int $vehicleId, string $title, ?string $description, ?string $url, string $start, string $end, ?int $serviceId)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->vehicleId = $vehicleId;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->start = $start;
        $this->end = $end;
        $this->serviceId = $serviceId;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getVehicleId(): ?int
    {
        return $this->vehicleId;
    }
    public function setVehicleId(int $vehicleId): void
    {
        $this->vehicleId = $vehicleId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getStartDate(): string
    {
        return $this->start;
    }
    public function setStartDate(string $start): void
    {
        $this->start = $start;
    }

    public function getEndDate(): string
    {
        return $this->end;
    }
    public function setEndDate(string $end): void
    {
        $this->end = $end;
    }
    
      public function getServiceId(): ?int
    {
        return $this->serviceId; // Méthode pour obtenir la valeur de l'ID du service
    }

    public function setServiceId(?int $serviceId): void
    {
        $this->serviceId = $serviceId; // Méthode pour définir la valeur de l'ID du service
    }

}
