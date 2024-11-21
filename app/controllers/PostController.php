<?php

namespace app\controllers;

use app\models\Post;

class PostController
{
    public function getAllPosts() {
        $postModel = new Post();
        header("Content-Type: application/json");
        echo json_encode($postModel->getAllPosts());
        exit();
    }

    public function getPostById($id) {
        $postModel = new Post();
        header("Content-Type: application/json");
        echo json_encode($postModel->getPostById($id));
        exit();
    }

    public function savePost() {
        $inputData = [
            'title' => $_POST['title'] ?? '',
            'content' => $_POST['content'] ?? '',
        ];

        $postModel = new Post();
        $postModel->savePost($inputData);

        http_response_code(200);
        echo json_encode(['success' => true]);
        exit();
    }

    public function updatePost($id) {
        parse_str(file_get_contents("php://input"), $_PUT);

        $inputData = [
            'id' => $id,
            'title' => $_PUT['title'] ?? '',
            'content' => $_PUT['content'] ?? '',
        ];

        $postModel = new Post();
        $postModel->updatePost($inputData);

        http_response_code(200);
        echo json_encode(['success' => true]);
        exit();
    }

    public function deletePost($id) {
        $postModel = new Post();
        $postModel->deletePost(['id' => $id]);

        http_response_code(200);
        echo json_encode(['success' => true]);
        exit();
    }

    public function postsView() {
        include '../public/assets/views/post/posts-view.html';
        exit();
    }

    public function postsAddView() {
        include '../public/assets/views/post/posts-add.html';
        exit();
    }

    public function postsUpdateView() {
        include '../public/assets/views/post/posts-update.html';
        exit();
    }

    public function postsDeleteView() {
        include '../public/assets/views/post/posts-delete.html';
        exit();
    }
}
