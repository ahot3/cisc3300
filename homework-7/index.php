<?php
require 'controllers/notes_controller.php';
use controllers\NotesController;

$uri = isset($_GET['url']) ? explode("/", trim($_GET['url'], "/")) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($uri) && $uri[0] === "submit") {
    $controller = new NotesController();
    echo $controller->submitNote();
} else {
    require 'views/notes_form.php';
}
?>
