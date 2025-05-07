<?php

declare(strict_types=1);

namespace Lucancstr\GestionChenil\Models;

use Lucancstr\GestionChenil\Models\Databases;
use PDO;

class Animal
{
    // protected $map = [
    //     ''
    // ];

    public ?int $idUser = null;

    public ?string $firstname = null;

    public ?string $name = null;

    public ?string $email = null;

    public ?string $password = null;

    public ?date $birthdate = null;

    public static function getAllWithProprietaire()
    {
        $pdo = Database::connection();
        $stmt = $pdo->query("
            SELECT 
                ANIMAUX.*, 
                UTILISATEURS.Nom AS NomProprietaire, 
                UTILISATEURS.Prenom AS PrenomProprietaire
            FROM ANIMAUX
            LEFT JOIN UTILISATEURS ON ANIMAUX.IdProprietaire = UTILISATEURS.IdUtilisateur
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAnimalById($id)
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare("SELECT IdAnimal, NomAnimal, Race, Age, Sexe, Poids, Taille, Alimentation, IdProprietaire FROM ANIMAUX WHERE IdProprietaire = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function addAnimal($NomAnimal, $Race, $Age, $Sexe, $Poids, $Taille, $Alimentation, $IdProprietaire)
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare("INSERT INTO ANIMAUX 
            (NomAnimal, Race, Age, Sexe, Poids, Taille, Alimentation, IdProprietaire)
            VALUES (:NomAnimal, :Race, :Age, :Sexe, :Poids, :Taille, :Alimentation, :IdProprietaire)");
    
        $stmt->bindParam(':NomAnimal', $NomAnimal);
        $stmt->bindParam(':Race', $Race);
        $stmt->bindParam(':Age', $Age, PDO::PARAM_INT);
        $stmt->bindParam(':Sexe', $Sexe);
        $stmt->bindParam(':Poids', $Poids);
        $stmt->bindParam(':Taille', $Taille);
        $stmt->bindParam(':Alimentation', $Alimentation);
        $stmt->bindParam(':IdProprietaire', $IdProprietaire, PDO::PARAM_INT);
    
        $stmt->execute();
    }

    public static function deleteById($id)
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare("DELETE FROM ANIMAUX WHERE IdAnimal = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
