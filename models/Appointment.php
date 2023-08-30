<?php
class Appointment
{
    private ?int $appointmentId;
    private ?int $userId;
    private ?int $serviceId;
    private string $appointmentDatetime;

    public function __construct(?int $appointmentId, ?int $userId, ?int $serviceId, string $appointmentDatetime)
    {
        $this->appointmentId = $appointmentId;
        $this->userId = $userId;
        $this->serviceId = $serviceId;
        $this->appointmentDatetime = $appointmentDatetime;
    }

    public function getAppointmentId(): ?int
    {
        return $this->appointmentId;
    }

    public function setAppointmentId(int $appointmentId): void
    {
        $this->appointmentId = $appointmentId;
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

    public function getAppointmentDatetime(): string
    {
        return $this->appointmentDatetime;
    }

    public function setAppointmentDatetime(string $appointmentDatetime): void
    {
        $this->appointmentDatetime = $appointmentDatetime;
    }
}
