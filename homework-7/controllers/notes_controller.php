<?php
namespace controllers;

class NotesController {
    public function submitNote() {
        if (!isset($_POST['title']) || !isset($_POST['description'])) {
            return file_get_contents("views/error.php");
        }

        $title = htmlspecialchars(trim($_POST['title']));
        $description = htmlspecialchars(trim($_POST['description']));

        if (strlen($title) < 3 || strlen($description) < 10) {
            return file_get_contents("views/error.php");
        }

        return file_get_contents("views/success.php");
    }
}
?>
