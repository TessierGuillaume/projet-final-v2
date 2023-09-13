<?php
class Event
{

    private ?int $id;
    private ?int $userId;
    private ?int $vehicleId;
    private string $title;
    private ?string $description;
    private ?string $url;
    private string $start; // Correspond à la colonne "start" de la table
    private string $end;   // Correspond à la colonne "end" de la table

    public function __construct(?int $id, ?int $userId, ?int $vehicleId, string $title, ?string $description, ?string $url, string $start, string $end)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->vehicleId = $vehicleId;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->start = $start;
        $this->end = $end;
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
}
