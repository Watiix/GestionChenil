<?php

use Lucancstr\GestionChenil\Controllers\HomeController;
use Lucancstr\GestionChenil\Controllers\AuthController;
use Lucancstr\GestionChenil\Controllers\AnimalController;
use Lucancstr\GestionChenil\Controllers\UtilisateurController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/', [HomeController::class, 'showHomePage']);
$app->get('/register', [HomeController::class, 'showRegisterPage']);
$app->get('/login', [HomeController::class, 'showLoginPage']);

$app->post('/register-post', [AuthController::class, 'createAccount']);
$app->post('/login-post', [AuthController::class, 'login']);
$app->get('/logout', [AuthController::class, 'logout']);

$app->get('/animaux', [AnimalController::class, 'getAnimaux']);
$app->post('/animal-post', [AnimalController::class, 'addAnimal']);
$app->get('/animal-form', [AnimalController::class, 'showAnimalFormPage']);
$app->get('/animal-delete/{id:[0-9]+}', [AnimalController::class, 'deleteAnimal']);
$app->get('/animal-edit/{id:[0-9]+}', [AnimalController::class, 'showEditForm']);
$app->post('/animal-update/{id:[0-9]+}', [AnimalController::class, 'updateAnimal']);

$app->get('/utilisateurs', [UtilisateurController::class, 'getUsers']);
$app->get('/utilisateur-accepted/{id:[0-9]+}', [UtilisateurController::class, 'acceptUser']);
$app->get('/utilisateur-refused/{id:[0-9]+}', [UtilisateurController::class, 'refusedUser']);
$app->get('/utilisateur-delete/{id:[0-9]+}', [UtilisateurController::class, 'refusedUser']);

$app->get('/utilisateur-showForm', [UtilisateurController::class, 'showUserForm']);
$app->get('/utilisateur-edit/{id:[0-9]+}', [UtilisateurController::class, 'editUser']);
$app->post('/utilisateur-add', [UtilisateurController::class, 'addUtilisateur']);



// $app->get('/profile', [HomeController::class, 'showProfilePage']);

// $app->post('/update/user', [UtilisateurController::class, 'updateUser']);

// $app->post('/test/create', [TestController::class, 'create']);