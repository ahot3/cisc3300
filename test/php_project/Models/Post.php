<?php
namespace Models;

class Post {
    public function getPosts(): array {
        return [
            ["title" => "First Post", "description" => "This is the first post!"],
            ["title" => "Second Post", "description" => "This is the second post!"],
            ["title" => "Third Post", "description" => "This is the third post!"]
        ];
    }
}
?>
