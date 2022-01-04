<?php


class DB {

    /**
     * Create tables if not exists
     * 
     * @return void
     * @since 1.0
     */
    public static function createTables() {
        $pdo = Connection::getPdo();
        
        $tables = [
            "CREATE TABLE IF NOT EXISTS `users` ( `user_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT , `user_fullname` VARCHAR(60) NULL , `user_email` VARCHAR(60) NOT NULL , `user_password` VARCHAR(40) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`user_id`)) ENGINE = InnoDB;"
        ];

        foreach ($tables as $table ) {
            $pdo->prepare($table)->execute();
        }

    }

    /**
     * Login a user
     * 
     * @param string $email
     * @param string $password
     * @return array|bool
     * @since 1.0
     */
    public static function login($email, $password) {
        
        if ( !self::is_user_exists( $email ) ) {
            return false;
        }

        $query = "SELECT * FROM users WHERE user_email = :email AND user_password = :password";

        $password = sha1( 'yisdft4783gfwjksdfh89' . $password );

        $params = [
            ':email' => $email,
            ':password' => $password
        ];

        $user = Connection::row($query, $params);

        if ($user) {
            unset($user['user_password']);
            return $user;
        }

        return false;
    }

    /**
     * Signup a user
     * 
     * @param string $email
     * @param string $password
     * @param string $fullname
     * @return array|bool
     * @since 1.0
     */
    public static function signup($email, $password, $fullname) {

        if ( self::is_user_exists( $email ) ) {
            response(
                [
                    'status' => 'error',
                    'message' => 'Email already exists'
                ],
                403
            );
        }

        $query = "INSERT INTO users (user_email, user_password, user_fullname) VALUES (:email, :password, :fullname)";

        $password = sha1( 'yisdft4783gfwjksdfh89' . $password );
        $params = [
            ':email' => $email,
            ':password' => $password,
            ':fullname' => $fullname
        ];

        $user = Connection::query($query, $params);

        if ($user) {
            return self::login($email, $password);
        }

        return false;
    }

    /**
     * Check see is user exists or not
     * 
     * @param string $email
     * @return bool
     */
    public static function is_user_exists( $email ) {
        $query = "SELECT * FROM users WHERE user_email = :email";
        $params = [
            ':email' => $email
        ];

        $user = Connection::row($query, $params);

        if ($user) {
            return true;
        }

        return false;
    }
}