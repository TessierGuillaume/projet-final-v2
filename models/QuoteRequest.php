<?php
class QuoteRequest
{
    private ?int $requestId;
    private ?int $userId;
    private ?int $serviceId;
    private string $requestStatus;

    public function __construct(?int $requestId, ?int $userId, ?int $serviceId, string $requestStatus)
    {
        $this->requestId = $requestId;
        $this->userId = $userId;
        $this->serviceId = $serviceId;
        $this->requestStatus = $requestStatus;
    }
    public function getRequestId(): ?int
    {
        return $this->requestId;
    }
    public function setRequestId(int $requestId): void
    {
        $this->requestId = $requestId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getServiceId(): ?int
    {
        return $this->serviceId;
    }
    public function setServiceId(int $serviceId): void
    {
        $this->serviceId = $serviceId;
    }

    public function getRequestStatus(): string
    {
        return $this->requestStatus;
    }
    public function setRequestStatus(string $requestStatus): void
    {
        $this->requestStatus = $requestStatus;
    }
    // Getters et setters ici...
}
