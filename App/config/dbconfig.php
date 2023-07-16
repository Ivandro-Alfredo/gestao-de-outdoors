<?php

class DatabaseConnection {
	private static $username = "root";
    private static $hostname = "localhost";
    private static $password = "";
    private static $connectionInstance = null;

	private function __construct() {}

	public static function getInstance() {
		if (!isset(self::$connectionInstance)) {
            try {
				self::$connectionInstance = new PDO("mysql:host=".self::$hostname.";dbname=outdoorbd", self::$username, self::$password);
				self::$connectionInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "O correu um erro durante a conexão: " . $e->getMessage();
            }
        }
        return self::$connectionInstance;
    }
}

?>