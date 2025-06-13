<?php

class Croissant implements JsonSerializable {
   
    protected $id;
    private $croissanteur;
    private $imprudent;
    private $date;

    public function __construct($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            "croissanteur"=> $this->croissanteur,
            "imprudent"=> $this->imprudent,
            "date"=> $this->date,
        ];
    }
    public function getCroissanteur(): string {
        return $this->croissanteur;
    }

    public function setCroissanteur(string $croissanteur): void {
        $this->croissanteur = $croissanteur;
    }

    public function getImprudent(): string {
        return $this->imprudent;
    }

    public function setImprudent(string $imprudent): void {
        $this->imprudent = $imprudent;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function setDate(string $date): void {
        $this->date = $date;
    }
   
}