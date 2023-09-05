<?php
class Service
{
    private ?int $Service_ID;
    private string $Service_name;
    private ?string $Service_description;
    private float $Service_cost;

    public function __construct(?int $Service_ID, string $Service_name, ?string $Service_description, float $Service_cost)
    {
        $this->Service_ID = $Service_ID;
        $this->Service_name = $Service_name;
        $this->Service_description = $Service_description;
        $this->Service_cost = $Service_cost;
    }

    public function getService_ID(): ?int
    {
        return $this->Service_ID;
    }

    public function setService_ID(?int $Service_ID): void
    {
        $this->Service_ID = $Service_ID;
    }

    public function getService_name(): string
    {
        return $this->Service_name;
    }

    public function setService_name(string $Service_name): void
    {
        $this->Service_name = $Service_name;
    }

    public function getService_description(): ?string
    {
        return $this->Service_description;
    }

    public function setService_description(?string $Service_description): void
    {
        $this->Service_description = $Service_description;
    }

    public function getService_cost(): float
    {
        return $this->Service_cost;
    }

    public function setService_cost(float $Service_cost): void
    {
        $this->Service_cost = $Service_cost;
    }
}
