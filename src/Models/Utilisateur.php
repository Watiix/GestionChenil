<?php

declare(strict_types=1);

namespace Lucancstr\GestionChenil\Models;

use Lucancstr\GestionChenil\Models\Databases;
use PDO;

class Utilisateur
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


    public static function validatePassword(string $password): void
    {
        if (strlen($password) < 5) {
            throw new \Exception("Le mot de passe doit contenir au moins 5 caractères.");
        }

        // Vérifie si le premier caractère est une majuscule
        if (!ctype_upper($password[0])) {
            throw new \Exception("Le mot de passe doit commencer par une majuscule.");
        }

        if (!preg_match('/[\W]/', $password)) { // \W = tout ce qui n'est pas a-zA-Z0-9_
            throw new \Exception("Le mot de passe doit contenir au moins un caractère spécial.");
        }
    }

    public static function validateDate(string $date, string $format): void
    {
        $d = \DateTime::createFromFormat($format, $date);

        // Si la création échoue ou si la date après formatage ne correspond pas à l'entrée -> KO
        if (!$d || $d->format($format) !== $date) {
            throw new \Exception("La date '$date' n'est pas valide. Format attendu : $format");
        }

         // Comparer avec la date du jour
        $today = new \DateTime(); // maintenant
        if ($d > $today) {
            throw new \Exception("La date '$date' ne peut pas être dans le futur.");
        }
    }

    public static function emailAlreadyExist($email) :bool{
        $pdo = Database::connection();

        $stmt = $pdo->prepare("SELECT * FROM UTILISATEURS WHERE Email = :Email");
        $stmt->bindParam(':Email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user){
            return true;
        }

        return false;     
    }
    
    public static function createAccount($name, $firstname, $pseudo, $password, $email, $birthdate) {
        try {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
            $pdo = Database::connection();
            $stmt = $pdo->prepare("
                INSERT INTO UTILISATEURS (Nom, Prenom, Pseudo, MotDePasse, Email, DateNaissance, Statut)
                VALUES (:name, :firstname, :pseudo, :password, :email, :birthdate, 1)
            ");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':password', $passwordHash); // ici tu utilises bien le hash
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->execute();
        } catch (\PDOException $e) {
            // Propage l'exception au contrôleur
            throw new \Exception("Erreur lors de la création du compte : " . $e->getMessage());
        }
    }

    public static function login($email, $password) {

        $pdo = Database::connection();

        $stmt = $pdo->prepare("SELECT * FROM UTILISATEURS WHERE Email = :Email");
        $stmt->bindParam(':Email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['MotDePasse'])) {
                return $user;
            } else {
                throw new \Exception("Mot de passe incorrect !");
            }
        } else {
            // Email n'existe pas
            throw new \Exception("Email inexistant !");
        }
    }

    public static function getUserbyId($id)
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare("SELECT IdUtilisateur, Nom, Prenom, Pseudo, Email, DateNaissance, Statut FROM UTILISATEURS WHERE IdUtilisateur = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}