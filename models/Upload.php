<?php
class Upload
{
    private ?int $id;
    private string $nom_fichier;
    private string $chemin_d_acces;
    private int $taille;
    private string $date_upload;
    private ?int $User_ID;
    private string $type_fichier;
    private ?int $Message_ID;

    public function __construct(?int $id, string $nom_fichier, string $chemin_d_acces, int $taille, string $date_upload, ?int $User_ID, string $type_fichier, ?int $Message_ID)
    {
        $this->id = $id;
        $this->nom_fichier = $nom_fichier;
        $this->chemin_d_acces = $chemin_d_acces;
        $this->taille = $taille;
        $this->date_upload = $date_upload;
        $this->User_ID = $User_ID;
        $this->type_fichier = $type_fichier;
        $this->Message_ID = $Message_ID;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNomFichier(): string
    {
        return $this->nom_fichier;
    }
    public function setNomFichier(string $nom_fichier): void
    {
        $this->nom_fichier = $nom_fichier;
    }

    public function getCheminDAcces(): string
    {
        return $this->chemin_d_acces;
    }
    public function setCheminDAcces(string $chemin_d_acces): void
    {
        $this->chemin_d_acces = $chemin_d_acces;
    }

    public function getTaille(): int
    {
        return $this->taille;
    }
    public function setTaille(int $taille): void
    {
        $this->taille = $taille;
    }

    public function getDateUpload(): string
    {
        return $this->date_upload;
    }
    public function setDateUpload(string $date_upload): void
    {
        $this->date_upload = $date_upload;
    }

    public function getUserID(): ?int
    {
        return $this->User_ID;
    }
    public function setUserID(?int $User_ID): void
    {
        $this->User_ID = $User_ID;
    }

    public function getTypeFichier(): string
    {
        return $this->type_fichier;
    }
    public function setTypeFichier(string $type_fichier): void
    {
        $this->type_fichier = $type_fichier;
    }

    public function getMessageID(): ?int
    {
        return $this->Message_ID;
    }
    public function setMessageID(?int $Message_ID): void
    {
        $this->Message_ID = $Message_ID;
    }
}
