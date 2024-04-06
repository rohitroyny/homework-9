<?php

namespace app\controllers;

use app\models\Post;

class PostController
{
    public function validatePost($inputData) {
        $errors = [];
        $title = $inputData['title'];
        $description = $inputData['description'];

        if ($title) {
            $title = htmlspecialchars($title, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($title) < 2) {
                $errors['titleShort'] = 'title is too short';
            }
        } else {
            $errors['titleRequired'] = 'title is required';
        }

        if ($description) {
            $description = htmlspecialchars($description, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($description) < 2) {
                $errors['descriptionShort'] = 'description is too short';
            }
        } else {
            $errors['descriptionRequired'] = 'description is required';
        }

        if (count($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            exit();
        }
        return [
            'title' => $title,
            'description' => $description,
        ];
    }

    public function getPosts($id) {
        $postModel = new Post(); 
        header("Content-Type: application/json");
        if ($id) {
            //TODO 5-c i: get a post data by id
            $posts = $postModel->getPostById($id); 
        } else {
            //TODO 5-a: get all posts
            $posts = $postModel->getAllPosts(); 
        }

        echo json_encode($posts);
        exit();
    }

@@ -58,8 +59,13 @@ public function savePost() {
        ];
        $postData = $this->validatePost($inputData);

        //TODO 5-b: save a post

        $post = new Post(); 
        $post->savePost(
            [
                'title' => $postData['title'],
                'description' => $postData['description'],
            ]
        );
        http_response_code(200);
        echo json_encode([
            'success' => true
@@ -72,7 +78,6 @@ public function updatePost($id) {
            http_response_code(404);
            exit();
        }

        //no built-in super global for PUT
        parse_str(file_get_contents('php://input'), $_PUT);

@@ -83,6 +88,14 @@ public function updatePost($id) {
        $postData = $this->validatePost($inputData);

        //TODO 5-c: update a post
        $post = new Post();
        $post->updatePost(
            [
                'id' => $id, 
                'title' => $postData['title'],
                'description' => $postData['description'],
            ]
        );

        http_response_code(200);
        echo json_encode([
@@ -98,6 +111,12 @@ public function deletePost($id) {
        }

        //TODO 5-d: delete a post
        $post = new Post();
        $post->deletePost(
            [
                'id' => $id,
            ]
        );

        http_response_code(200);
        echo json_encode([
@@ -121,7 +140,7 @@ public function postsDeleteView() {
        exit();
    }

    public function postsUpdateView() {
    public function postsUpdateView() { 
        include '../public/assets/views/post/posts-update.html';
        exit();
    }
