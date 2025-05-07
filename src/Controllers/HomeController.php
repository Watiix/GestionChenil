<?php
namespace Lucancstr\GestionChenil\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class HomeController extends BaseController {

    public function showHomePage(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        if (!isset($_SESSION['user'])) {
            return $response
                ->withHeader('Location', '/login')
                ->withStatus(302);
        }
        
        return $this->view->render($response, 'home-page.php');
    }

    public function showLoginPage(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {   
        return $this->renderWithoutLayout($response, 'login.php');
    }

    public function showRegisterPage(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {   
        return $this->renderWithoutLayout($response, 'register.php');
    }
}