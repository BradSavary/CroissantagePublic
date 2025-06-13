<?php
require_once "Repository/EntityRepository.php";
require_once "Class/Croissant.php";


class CroissantRepositery extends EntityRepository {

    public function __construct() {
        parent::__construct();
    }

    public function addCroissant($croissanteur, $imprudent, $date) {
        try {
            $sql = $this->cnx->prepare('INSERT INTO croissant (croissanteur, imprudent, date) VALUES (:croissanteur, :imprudent, :date)');
            $sql->bindParam(':croissanteur', $croissanteur);
            $sql->bindParam(':imprudent', $imprudent);
            $sql->bindParam(':date', $date);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            // Log l'erreur et la renvoyer
            error_log("Erreur SQL dans addCroissant: " . $e->getMessage());
            throw new Exception("Erreur lors de l'ajout du croissant: " . $e->getMessage());
        }
    }
    public function find($empty){

    }
    public function findAll(){
        $sql = $this->cnx->prepare('SELECT * FROM croissant');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public function save($empty){

    }

    public function delete($empty){

    }
    public function update($empty){

    }
}

?>