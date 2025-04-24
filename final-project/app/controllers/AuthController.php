<?php
namespace app\controllers;

use app\models\User;

class AuthController extends Controller
{
    private function regenerateSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        session_regenerate_id(true);
    }
    
    public function registerView(): void
    {
        $this->view('auth/register');
    }
    
    public function loginView(): void
    {
        $this->view('auth/login');
    }
    
    public function register(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON data']);
            return;
        }
        
        $errors = [];
        
        if (empty($data['username'])) {
            $errors['username'] = 'Username is required';
        } elseif (strlen($data['username']) < 3) {
            $errors['username'] = 'Username must be at least 3 characters';
        }
        
        if (empty($data['email'])) {
            $errors['email'] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Valid email is required';
        }
        
        if (empty($data['password'])) {
            $errors['password'] = 'Password is required';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = 'Password must be at least 6 characters';
        }
        
        if ($data['password'] !== $data['confirm_password']) {
            $errors['confirm_password'] = 'Passwords do not match';
        }
        
        if (!empty($errors)) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }
        
        try {
            $user = User::register(
                $data['username'],
                $data['email'],
                $data['password']
            );
            
            $this->regenerateSession();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            
            echo json_encode([
                'success' => true,
                'message' => 'Registration successful',
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email
                ]
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
    public function login(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON data']);
            return;
        }
        
        $errors = [];
        
        if (empty($data['username'])) {
            $errors['username'] = 'Username is required';
        }
        
        if (empty($data['password'])) {
            $errors['password'] = 'Password is required';
        }
        
        if (!empty($errors)) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }
        
        $user = User::login($data['username'], $data['password']);
        
        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid username or password']);
            return;
        }
        
        $this->regenerateSession();
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        
        echo json_encode([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email
            ]
        ]);
    }
    
    public function logout(): void
    {
        session_start();
        
        $_SESSION = [];
        
        session_destroy();
        
        header('Location: /');
        exit;
    }
    
    public function getCurrentUser(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        
        session_start();
        
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['isAuthenticated' => false]);
            return;
        }
        
        $user = User::getById($_SESSION['user_id']);
        
        if (!$user) {
            $_SESSION = [];
            session_destroy();
            
            echo json_encode(['isAuthenticated' => false]);
            return;
        }
        
        echo json_encode([
            'isAuthenticated' => true,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email
            ]
        ]);
    }
}