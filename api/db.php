<?php

class DB {
    private $pdo;
    
    public function __construct() {
        $this->connect();
    }
    
    public function connect() {
        // Essayer DATABASE_URL d'abord (format: mysql://user:pass@host:port/db)
        $url = getenv('DATABASE_URL') ?: getenv('MYSQL_PUBLIC_URL');
        
        if ($url) {
            $parsed = parse_url($url);
            $host = $parsed['host'];
            $port = $parsed['port'] ?? 3306;
            $user = $parsed['user'];
            $pass = $parsed['pass'] ?? '';
            $db = ltrim($parsed['path'], '/');
        } else {
            $host = DB_HOST;
            $port = DB_PORT;
            $user = DB_USER;
            $pass = DB_PASS;
            $db = DB_NAME;
        }
        
        $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";
        $this->pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    public function queryOne($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }
    
    public function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    
    public function lastId() {
        return $this->pdo->lastInsertId();
    }
}
?>
