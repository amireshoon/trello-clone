<?php

class ConnectionConfig {

    /**
     * @var string
     * database host
     * 
     * @since 1.0
     */
    protected $host = 'localhost';

    /**
     * @var string
     * database name
     * 
     * @since 1.0
     */
    protected $dbname = 'trello-clone';

    /**
     * @var string
     * database username
     * 
     * @since 1.0
     */
    protected $username = 'root';

    /**
     * @var string
     * database password
     * 
     * @since 1.0
     */
    protected $password = '';

    public function getHost() {
        return $this->host;
    }

    public function getDbname() {
        return $this->dbname;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDsn() {
        return "mysql:host={$this->host};dbname={$this->dbname}";
    }

    public function setHost( $host ) {
        $this->host = $host;
    }

    public function setDbname( $dbname ) {
        $this->dbname = $dbname;
    }

    public function setUsername( $username ) {
        $this->username = $username;
    }

    public function setPassword( $password ) {
        $this->password = $password;
    }

    public function getOptions() {
        return [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
    }


}