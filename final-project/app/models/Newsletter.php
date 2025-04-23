<?php
namespace app\models;

use PDO;

class Newsletter extends Model
{
    public int $id;
    public string $email;
    public string $name;
    public string $created_at;

    public function __construct(array $data)
    {
        $this->id = (int)$data['id'];
        $this->email = $data['email'];
        $this->name = $data['name'] ?? '';
        $this->created_at = $data['created_at'];
    }

    public static function subscribe(string $email, string $name = ''): self
    {
        error_log("Newsletter::subscribe - Starting for email: " . $email);
        
        // Sanitize inputs
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        
        error_log("Newsletter::subscribe - Sanitized: email=" . $email . ", name=" . $name);
        
        try {
            error_log("Newsletter::subscribe - Getting database connection");
            $db = self::db();
            
            $tableCheck = $db->query("SHOW TABLES LIKE 'newsletter_subscribers'");
            if ($tableCheck->rowCount() === 0) {
                error_log("Newsletter::subscribe - Table 'newsletter_subscribers' doesn't exist");
                
                $createTable = "CREATE TABLE `newsletter_subscribers` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `email` varchar(100) NOT NULL,
                    `name` varchar(100) DEFAULT '',
                    `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                    `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `email` (`email`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
                
                $db->exec($createTable);
                error_log("Newsletter::subscribe - Created 'newsletter_subscribers' table");
            }
            
            $checkStmt = $db->prepare("SELECT id FROM newsletter_subscribers WHERE email = :email");
            $checkStmt->execute(['email' => $email]);
            $exists = $checkStmt->fetch();
            
            if ($exists) {
                $sql = "UPDATE newsletter_subscribers SET updated_at = NOW()";
                
                if (!empty($name)) {
                    $sql .= ", name = :name";
                    $params = [
                        'name' => $name,
                        'id' => $exists['id']
                    ];
                } else {
                    $params = [
                        'id' => $exists['id']
                    ];
                }
                
                $sql .= " WHERE id = :id";
                
                $stmt = $db->prepare($sql);
                $stmt->execute($params);
                
                $stmt = $db->prepare("SELECT * FROM newsletter_subscribers WHERE id = :id");
                $stmt->execute(['id' => $exists['id']]);
                return new self($stmt->fetch());
            } else {
                $sql = "INSERT INTO newsletter_subscribers (email, name, created_at) VALUES (:email, :name, NOW())";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    'email' => $email,
                    'name' => $name
                ]);
                
                $id = (int)$db->lastInsertId();
                
                return new self([
                    'id' => $id,
                    'email' => $email,
                    'name' => $name,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        } catch (\PDOException $e) {
            error_log("PDOException in Newsletter::subscribe: " . $e->getMessage());
            error_log("SQL State: " . $e->getCode());
            throw new \Exception("Database error occurred: " . $e->getMessage());
        } catch (\Exception $e) {
            error_log("Exception in Newsletter::subscribe: " . $e->getMessage());
            throw $e;
        }
    }

    public static function getAll(): array
    {
        try {
            $db = self::db();
            $stmt = $db->query("SELECT * FROM newsletter_subscribers ORDER BY created_at DESC");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return array_map(fn($row) => new self($row), $rows);
        } catch (\Exception $e) {
            error_log("Exception in Newsletter::getAll: " . $e->getMessage());
            throw $e;
        }
    }
}