<?php
namespace app\core;

use app\controllers\MainController;
use app\controllers\ContactController;
use app\controllers\ReviewController;
use app\controllers\AuthController;

class Router
{
    private string $method;
    private string $path;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = strtok($_SERVER['REQUEST_URI'], '?') ?: '/';
        
        error_log("Router: Method={$this->method}, Path={$this->path}");
        
        $this->dispatch();
    }

    private function dispatch(): void
    {
        // Handle favicon request
        if ($this->method === 'GET' && $this->path === '/favicon.ico') {
            $faviconPath = __DIR__ . '/../../public/assets/images/favicon.ico';
            if (file_exists($faviconPath)) {
                header('Content-Type: image/x-icon');
                readfile($faviconPath);
            } else {
                http_response_code(404);
            }
            return;
        }
        
        if ($this->method === 'GET' && $this->path === '/register') {
            error_log("Router: Dispatching to AuthController->registerView()");
            (new AuthController())->registerView();
            return;
        }

        if ($this->method === 'GET' && $this->path === '/login') {
            error_log("Router: Dispatching to AuthController->loginView()");
            (new AuthController())->loginView();
            return;
        }

        if ($this->method === 'GET' && $this->path === '/logout') {
            error_log("Router: Dispatching to AuthController->logout()");
            (new AuthController())->logout();
            return;
        }

        if ($this->method === 'POST' && $this->path === '/api/register') {
            error_log("Router: Dispatching to AuthController->register()");
            (new AuthController())->register();
            return;
        }

        if ($this->method === 'POST' && $this->path === '/api/login') {
            error_log("Router: Dispatching to AuthController->login()");
            (new AuthController())->login();
            return;
        }

        if ($this->method === 'GET' && $this->path === '/api/current-user') {
            error_log("Router: Dispatching to AuthController->getCurrentUser()");
            (new AuthController())->getCurrentUser();
            return;
        }
        
        if ($this->method === 'GET' && $this->path === '/') {
            error_log("Router: Dispatching to MainController->homepage()");
            (new MainController())->homepage();
            return;
        }

        if ($this->method === 'GET' && $this->path === '/about') {
            error_log("Router: Dispatching to MainController->about()");
            (new MainController())->about();
            return;
        }

        if ($this->method === 'GET' && $this->path === '/contact') {
            error_log("Router: Dispatching to ContactController->contactView()");
            (new ContactController())->contactView();
            return;
        }

        if ($this->method === 'GET' && $this->path === '/japan') {
            error_log("Router: Dispatching to MainController->japan()");
            (new MainController())->japan();
            return;
        }

        if ($this->method === 'GET' && $this->path === '/turkey') {
            error_log("Router: Dispatching to MainController->turkey()");
            (new MainController())->turkey();
            return;
        }

        if ($this->method === 'GET' && $this->path === '/montenegro') {
            error_log("Router: Dispatching to MainController->montenegro()");
            (new MainController())->montenegro();
            return;
        }

        if ($this->method === 'POST' && $this->path === '/api/contact') {
            error_log("Router: Dispatching to ContactController->postContact()");
            (new ContactController())->postContact();
            return;
        }

        if ($this->method === 'POST' && $this->path === '/api/newsletter') {
            error_log("Router: Dispatching to ContactController->postNewsletter()");
            (new ContactController())->postNewsletter();
            return;
        }

        if ($this->method === 'GET' && $this->path === '/api/reviews') {
            error_log("Router: Dispatching to ReviewController->getReviews()");
            (new ReviewController())->getReviews();
            return;
        }

        if ($this->method === 'POST' && $this->path === '/api/reviews') {
            error_log("Router: Dispatching to ReviewController->postReview()");
            (new ReviewController())->postReview();
            return;
        }
        
        if ($this->method === 'GET' && $this->path === '/test-newsletter') {
            error_log("Router: Testing Newsletter functionality");
            try {
                $newsletter = new \app\models\Newsletter([
                    'id' => 0,
                    'email' => 'test@example.com',
                    'name' => 'Test User',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                echo "Newsletter class loaded successfully.";
            } catch (\Throwable $e) {
                error_log("Newsletter test error: " . $e->getMessage());
                echo "Error: " . $e->getMessage();
            }
            return;
        }

        error_log("Router: No route found for {$this->method} {$this->path}");
        http_response_code(404);
        echo 'Not Found';
    }
}