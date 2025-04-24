<?php
namespace app\models;

use PDO;

class User extends Model
{
    public int $id;
    public string $username;
    public string $email;
    public string $created_at;

    public function __construct(array $data)
    {
        $this->id = (int)$data['id'];
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->created_at = $data['created_at'];
    }

    public static function register(string $username, string $email, string $password): self
    {
        // Check if username exists
        $stmt = self::db()->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->fetch()) {
            throw new \Exception("Username already taken");
        }

        // Check if email exists
        $stmt = self::db()->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            throw new \Exception("Email already registered");
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = self::db()->prepare(
            "INSERT INTO users (username, email, password, created_at) 
             VALUES (:username, :email, :password, NOW())"
        );
        
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);
        
        $id = (int)self::db()->lastInsertId();
        
        return new self([
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public static function login(string $username, string $password): ?self
    {
        $stmt = self::db()->prepare(
            "SELECT id, username, email, password, created_at 
             FROM users 
             WHERE username = :username"
        );
        
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        
        if (!$user || !password_verify($password, $user['password'])) {
            return null;
        }
        
        return new self($user);
    }

    public static function getById(int $id): ?self
    {
        $stmt = self::db()->prepare("SELECT id, username, email, created_at FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        
        if (!$user) {
            return null;
        }
        
        return new self($user);
    }
}