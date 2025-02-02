<?php
class Database {
    private $host = "localhost";
    private $db_name = "umrah_planner";
    private $username = "root";
    private $password = "";
    public $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    // Create a new record
    public function create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_map(function($value) {
            return "'" . $this->conn->real_escape_string($value) . "'";
        }, array_values($data)));
        $query = "INSERT INTO $table ($columns) VALUES ($values)";

        if ($this->conn->query($query) === TRUE) {
            return true;
        }

        return false;
    }

    // Check if email exists
    public function emailExists($email) {
        $query = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $count = 0;
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;
    }

    // Verify password
    public function verifyUserPassword($email, $password) {
        $query = "SELECT password_hash FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $hashedPassword = '';
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();

        if ($hashedPassword) {
            return password_verify($password, $hashedPassword);
        } else {
            return false;
        }
    }

    // Add a flight record
    public function addFlight($userId, $airline, $time, $departure, $destination, $quantity, $totalPrice, $flightDate) {
        $query = "INSERT INTO flights (user_id, airline, time, departure, destination, quantity, total_price, flight_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issssids", $userId, $airline, $time, $departure, $destination, $quantity, $totalPrice, $flightDate);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    // Read records
    public function read($table, $conditions = []) {
        $query = "SELECT * FROM $table";
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", array_map(function($key, $value) {
                return "$key = '" . $this->conn->real_escape_string($value) . "'";
            }, array_keys($conditions), $conditions));
        }

        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Get user ID by email
    public function getUserIdByEmail($email) {
        $email = $this->conn->real_escape_string($email);
        $query = "SELECT id FROM users WHERE email = '$email'";
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['id'];
        } else {
            return null;
        }
    }

    // Update a record
    public function update($table, $data, $conditions) {
        $set = implode(", ", array_map(function($key, $value) {
            return "$key = '" . $this->conn->real_escape_string($value) . "'";
        }, array_keys($data), $data));

        $where = implode(" AND ", array_map(function($key, $value) {
            return "$key = '" . $this->conn->real_escape_string($value) . "'";
        }, array_keys($conditions), $conditions));

        $query = "UPDATE $table SET $set WHERE $where";

        if ($this->conn->query($query) === TRUE) {
            return true;
        }

        return false;
    }

    // Delete a record
    public function delete($table, $conditions) {
        $where = implode(" AND ", array_map(function($key, $value) {
            return "$key = '" . $this->conn->real_escape_string($value) . "'";
        }, array_keys($conditions), $conditions));

        $query = "DELETE FROM $table WHERE $where";

        if ($this->conn->query($query) === TRUE) {
            return true;
        }

        return false;
    }
}

?>
