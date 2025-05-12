<?php
namespace Lucancstr\GestionChenil\Controllers;

use Lucancstr\GestionChenil\Models\Animal;
use Lucancstr\GestionChenil\Models\Utilisateur;
use Lucancstr\GestionChenil\Models\Reservation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;


class ReservationController extends BaseController {

    public function getReservation(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $user = $_SESSION['user'];
    
        if ($user['Statut'] !== 1) {
            $reservations = Reservation::getAllReservassssstion();
        } else {
            $reservations = Reservation::getAllReservation($user['IdUtilisateur']);
        }
    
        return $this->view->render($response, 'reservations.php', ['reservations' => $reservations]);
    }
}