<?php
namespace Controllers;

require_once __DIR__ . '/../Models/Post.php';
use Models\Post;

class PostsController {
    public function getPosts(): string {
        $postModel = new Post();
        return json_encode($postModel->getPosts());
    }
}
?>
