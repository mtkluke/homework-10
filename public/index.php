<?php
require_once "../app/models/Model.php";
require_once "../app/models/User.php";
require_once "../app/models/Post.php";
require_once "../app/controllers/UserController.php";
require_once "../app/controllers/PostController.php";

//set our env variables
$env = parse_ini_file('../.env');
define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);

use app\controllers\UserController;
use app\controllers\PostController;

//get uri without query strings
$uri = strtok($_SERVER["REQUEST_URI"], '?');

//get uri pieces
$uriArray = explode("/", $uri);
//0 = ""
//1 = users
//2 = 1

// Users Routing
$userController = new UserController();

//get all or a single user
if ($uriArray[1] === 'api' && $uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    //only id
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;

    if ($id) {
        $userController->getUserByID($id);
    } else {
        $userController->getAllUsers();
    }
}

//save user
if ($uriArray[1] === 'api' && $uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->saveUser();
}

//update user
if ($uriArray[1] === 'api' && $uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $userController->updateUser($id);
}

//delete user
if ($uriArray[1] === 'api' && $uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $userController->deleteUser($id);
}

//views
if ($uri === '/users-add' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $userController->usersAddView();
}

if ($uriArray[1] === 'users-update' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $userController->usersUpdateView();
}

if ($uriArray[1] === 'users-delete' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $userController->usersDeleteView();
}

if ($uriArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $userController->usersView();
}

// Posts Routing
$postController = new PostController();

//get all or a single post
if ($uriArray[1] === 'api' && $uriArray[2] === 'posts' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    //only id
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;

    if ($id) {
        $postController->getPostById($id);
    } else {
        $postController->getAllPosts();
    }
}

//save post
if ($uriArray[1] === 'api' && $uriArray[2] === 'posts' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $postController->savePost();
}

//update post
if ($uriArray[1] === 'api' && $uriArray[2] === 'posts' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $postController->updatePost($id);
}

//delete post
if ($uriArray[1] === 'api' && $uriArray[2] === 'posts' && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $postController->deletePost($id);
}

//views
if ($uri === '/posts-add' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $postController->postsAddView();
}

if ($uriArray[1] === 'posts-update' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $postController->postsUpdateView();
}

if ($uriArray[1] === 'posts-delete' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $postController->postsDeleteView();
}

if ($uriArray[1] === 'posts-view' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $postController->postsView();
}

include '../public/assets/views/notFound.html';
exit();

?>
