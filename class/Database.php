<?php

/**
 * Description of User
 *
 * @author Suharshana DsW
 * @web www.nysc.lk
 * */
class Database {

    private $host = 'localhost';
    private $name = 'nyscexam_question_db';
    private $user = 'root';
    private $password = '';
    public $DB_CON = NULL;

    // Shared connection reused by every `new Database()` within a single
    // request. This prevents opening hundreds of MySQL connections per page
    // (the main cause of "Too many connections" under high load).
    private static $sharedConnection = NULL;

    public function __construct() {
        // Reuse the already-open connection if one exists for this request.
        if (self::$sharedConnection !== NULL) {
            $this->DB_CON = self::$sharedConnection;
            return;
        }

        // Establish database connection (only happens once per request).
        $this->DB_CON = mysqli_connect($this->host, $this->user, $this->password, $this->name);

        // Check for connection errors
        if (mysqli_connect_errno()) {
            throw new Exception('Failed to connect to MySQL: ' . mysqli_connect_error());
        }

        // Set the character set to UTF-8 to support Sinhala characters
        if (!mysqli_set_charset($this->DB_CON, "utf8mb4")) {
            throw new Exception('Error loading character set utf8mb4: ' . mysqli_error($this->DB_CON));
        }

        // Remember it so subsequent `new Database()` calls reuse it.
        self::$sharedConnection = $this->DB_CON;
    }

    // Function to execute read queries (SELECT)
    public function readQuery($query) {
        $result = mysqli_query($this->DB_CON, $query);
        if (!$result) {
            throw new Exception('Query failed: ' . mysqli_error($this->DB_CON));
        }
        return $result;
    }

    // Function to execute write queries (INSERT, UPDATE, DELETE)
    public function readQuery1($query) {
        $result = mysqli_query($this->DB_CON, $query);
        if ($result === TRUE) {
            // If query was successful, return the last inserted ID
            return $this->DB_CON->insert_id;
        } elseif (!$result) {
            // If query fails, throw an exception with the error message
            throw new Exception('Query failed: ' . mysqli_error($this->DB_CON));
        }
        return $result;
    }

    // Close the database connection.
    // NOTE: With the shared connection, we must NOT close it here, otherwise
    // every later `new Database()` in the same request would fail. The
    // connection is released automatically when the request ends.
    public function closeConnection() {
        return TRUE;
    }
}
