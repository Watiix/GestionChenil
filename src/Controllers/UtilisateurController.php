<?php
namespace Lucancstr\GestionChenil\Controllers;

use Lucancstr\GestionChenil\Models\Animal;
use Lucancstr\GestionChenil\Models\Utilisateur;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;


class UtilisateurController extends BaseController {

    public function getUsers(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $utilisateurs = Utilisateur::getAll(); // Récupère tous les utilisateurs

        return $this->view->render($response, 'utilisateurs.php', [
            'utilisateurs' => $utilisateurs
        ]);
    }

    public function acceptUser(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $idUtilisateur = $args['id'];

        Utilisateur::validateUser($idUtilisateur);
        $_SESSION['form_succes'] = "Utilisateur validé avec succès.";

        return $response->withHeader('Location', '/utilisateurs')->withStatus(302);
    }

    public function refusedUser(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $idUtilisateur = $args['id'];

        Utilisateur::refusedUser($idUtilisateur);
        $_SESSION['form_succes'] = "Supprimé avec succès.";

        return $response->withHeader('Location', '/utilisateurs')->withStatus(302);
    }

    public function showUserForm(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        return $this->view->render($response, 'utilisateurForm.php');
    }

    public function addUtilisateur(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {

        // Reset les messages
        unset($_SESSION['form_error']);
        unset($_SESSION['form_succes']);

        $post = $request->getParsedBody();

        // Nettoyage / Filtrage des champs
        $Nom = trim($post['Nom']);
        $Prenom = trim($post['Prenom']);
        $Pseudo = trim($post['Pseudo']);
        $MotDePasse = trim($post['MotDePasse']);
        $Email = trim($post['Email']);
        $DateNaissance = trim($post['DateNaissance']);
        $Statut = trim($post['Statut']);

        $data = [
            'name' => $Nom,
            'firstname' => $Prenom,
            'pseudo' => $Pseudo,
            'birthdate' => $Email,
            'email' => $DateNaissance,
            'statut' => $Statut
        ];

        // Vérification email valide
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['form_error'] = "L'email est invalide.";
        }

        if (
            empty($Nom) || empty($Prenom) || empty($Pseudo) || empty($MotDePasse)
            || empty($Email) || empty($DateNaissance) || empty($Statut)
        ) {
            $_SESSION['form_error'] = "Tous les champs doivent être remplis.";
        }

        // Email déjà utilisé
        if (Utilisateur::emailAlreadyExist($Email)) {
            $_SESSION['form_error'] = "Cet email est deja utilisé.";
        }

        try {
            Utilisateur::validatePassword($MotDePasse);
        } catch (\Exception $e) {
            $_SESSION['form_error'] = "Le mot de passe doit contenir au min. 5 lettres, une majuscule et un caractère spécial.";
        }   

        // Si pas d'erreur, on ajoute
        if (!isset($_SESSION['form_error'])) {
            try {
                Utilisateur::addUtilisateur($Nom, $Prenom, $Pseudo, $MotDePasse, $Email, $DateNaissance, $Statut);
                $_SESSION['form_succes'] = "Utilisateur ajouté avec succès.";
    
                return $response->withHeader('Location', '/utilisateurs')->withStatus(302);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        // T'ES ICI BG
        return $this->view->render($response->withStatus(302), 'utilisateurForm.php', ['data' => $data]);
    }
}