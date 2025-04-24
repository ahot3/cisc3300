<?php
error_log("Starting setup.php");

$projectRoot = realpath(__DIR__ . '/../../');
if (! $projectRoot) {
    error_log("Cannot resolve project root");
    throw new \Exception("Cannot resolve project root");
}
error_log("Project root: " . $projectRoot);

$envFile = $projectRoot . '/.env';
error_log("Env file path: " . $envFile);

if (!file_exists($envFile)) {
    error_log("Env file does not exist: " . $envFile);
}

$env = parse_ini_file($envFile, false, INI_SCANNER_RAW);
if ($env === false) {
    error_log("Failed to parse env file: " . $envFile);
    throw new \Exception("Unable to load .env at {$envFile}");
}

error_log("Env variables: " . print_r($env, true));

define('DB_HOST', $env['DB_HOST'] ?? 'localhost');
define('DB_NAME', $env['DB_NAME'] ?? 'final-project');
define('DB_USER', $env['DB_USER'] ?? 'root');
define('DB_PASS', $env['DB_PASS'] ?? '');

error_log("Database connection settings:");
error_log("DB_HOST: " . DB_HOST);
error_log("DB_NAME: " . DB_NAME);
error_log("DB_USER: " . DB_USER);
error_log("DB_PASS: [hidden]");

error_log("Loading Router.php");
require_once $projectRoot . '/app/core/Router.php';

error_log("Loading Controller.php");
require_once $projectRoot . '/app/controllers/Controller.php';

error_log("Loading MainController.php");
require_once $projectRoot . '/app/controllers/MainController.php';
error_log("Loading ContactController.php");
require_once $projectRoot . '/app/controllers/ContactController.php';
error_log("Loading ReviewController.php");
require_once $projectRoot . '/app/controllers/ReviewController.php';
error_log("Loading AuthController.php");
require_once $projectRoot . '/app/controllers/AuthController.php';

error_log("Loading Model.php");
require_once $projectRoot . '/app/models/Model.php';

error_log("Loading Review.php");
require_once $projectRoot . '/app/models/Review.php';
error_log("Loading Contact.php");
require_once $projectRoot . '/app/models/Contact.php';
error_log("Loading User.php");
require_once $projectRoot . '/app/models/User.php';

$newsletterFile = $projectRoot . '/app/models/Newsletter.php';
if (file_exists($newsletterFile)) {
    error_log("Loading Newsletter.php");
    require_once $newsletterFile;
} else {
    error_log("Newsletter.php does not exist at: " . $newsletterFile);
}

error_log("Initializing Router");
try {
    new \app\core\Router();
} catch (\Throwable $e) {
    error_log("Error initializing Router: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
    throw $e;
}