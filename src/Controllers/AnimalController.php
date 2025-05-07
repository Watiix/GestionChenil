<?php
namespace Lucancstr\GestionChenil\Controllers;

use Lucancstr\GestionChenil\Models\Animal;
use Lucancstr\GestionChenil\Models\Utilisateur;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;


class AnimalController extends BaseController {

    public function getAnimaux(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $user = $_SESSION['user'];
    
        if ($user['Statut'] !== 1) {
            $animaux = Animal::getAllWithProprietaire();
        } else {
            $animaux = Animal::getAnimalById($user['IdUtilisateur']);
        }
    
        return $this->view->render($response, 'animaux.php', ['animaux' => $animaux]);
    }

    public function showAnimalFormPage(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $isAdmin = ($_SESSION['user']['Statut'] ?? null) === 3;

        if ($isAdmin) {
            $utilisateurs = Utilisateur::getAll();

            return $this->view->render($response, 'animalForm.php', [
                'isAdmin' => $isAdmin,
                'utilisateurs' => $utilisateurs
            ]);
        }
        
        return $this->view->render($response, 'animalForm.php', [
            'isAdmin' => $isAdmin
        ]);
    }

    public function addAnimal(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        // reset les session
        unset($_SESSION['form_error']);
        unset($_SESSION['form_succes']);

        $user = $_SESSION['user'];
        $post = $request->getParsedBody();

        // Filtrage/Nettoyage
        $NomAnimal = trim($post['NomAnimal']);
        $Race = trim($post['Race']);
        $Age = trim($post['Age']);
        $Sexe = trim($post['Sexe']);
        $Poids = trim($post['Poids']);
        $Taille = trim($post['Taille']);
        $Alimentation = trim($post['Alimentation']);

        // Champs vides
        if (empty($NomAnimal) || empty($Race) || empty($Age) 
            || empty($Sexe) || empty($Poids) || empty($Taille) || empty($Alimentation)) {
            $_SESSION['form_error'] = "Tous les champs doivent être remplis.";
        }

        if($user['Statut'] === 3)
        {
            $id_utilisateur = $post['IdProprietaire'];
        }
        else
        {
            $id_utilisateur = $user['IdUtilisateur'];
        }

        if (!isset($_SESSION['form_error'])) {
            Animal::addAnimal($NomAnimal,$Race, $Age, $Sexe, $Poids, $Taille, $Alimentation, $id_utilisateur);
            $_SESSION['form_succes'] = "Animal ajouté avec succès.";   
        }

        return $response->withHeader('Location', '/animaux')->withStatus(302);
    }

    public function deleteAnimal(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $id = $args['id'];

        try {
            Animal::deleteById($id);
            $_SESSION['form_succes'] = "Animal supprimé avec succès.";
        } catch (\Exception $e) {
            $_SESSION['form_error'] = "Erreur lors de la suppression.";
        }
    
        return $response->withHeader('Location', '/animaux')->withStatus(302);
    }
}