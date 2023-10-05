<?php
class Message
{
    private ?int $messageId;
    private ?int $userId;
    private string $subject;
    private string $messageBody;
    private string $messageDatetime;

    public function __construct(?int $messageId, ?int $userId, string $subject, string $messageBody, string $messageDatetime)
    {
        $this->messageId = $messageId;
        $this->userId = $userId;
        $this->subject = $subject;
        $this->messageBody = $messageBody;
        $this->messageDatetime = $messageDatetime;
    }

    public function getMessageId(): ?int
    {
        return $this->messageId;
    }
    public function setMessageId(int $messageId): void
    {
        $this->messageId = $messageId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getMessageBody(): string
    {
        return $this->messageBody;
    }
    public function setMessageBody(string $messageBody): void
    {
        $this->messageBody = $messageBody;
    }

    public function getMessageDatetime(): string
    {
        return $this->messageDatetime;
    }
    public function setMessageDatetime(string $messageDatetime): void
    {
        $this->messageDatetime = $messageDatetime;
    }
    
}
