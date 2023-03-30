<?php
session_start();
class Database {
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($host, $username, $password, $dbname) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
      }
  
    public function connecter() {
      try {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        $this->conn = new PDO($dsn, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connexion réussie !";
        return $this->conn;
      } catch(PDOException $e) {
        echo "Connexion à la base de donnée échouée: " . $e->getMessage();
      }
    }

    public function inserer($table, $data) {
        try {
          $keys = implode(",", array_keys($data));
          $values = implode("','", array_values($data));
          $sql = "INSERT INTO " . $table . " (" . $keys . ") VALUES ('" . $values . "')";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          return true;
        } catch(PDOException $e) {
          echo "Insert failed: " . $e->getMessage();
          return false;
        }
      }

      public function modifier($table, $data, $condition) {
        try {
          $set = "";
          foreach ($data as $key => $value) {
            $set .= $key . "='" . $value . "',";
          }
          $set = rtrim($set, ",");
          $sql = "UPDATE " . $table . " SET " . $set . " WHERE " . $condition;
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          return true;
        } catch(PDOException $e) {
          echo "Update failed: " . $e->getMessage();
          return false;
        }
      }

      public function supprimer($table, $condition) {
        try {
          $sql = "DELETE FROM " . $table . " WHERE " . $condition;
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          return true;
        } catch(PDOException $e) {
          echo "Delete failed: " . $e->getMessage();
          return false;
        }
      }
    
      public function lire($table, $columns = "*", $condition = "") {
        try {
          $sql = "SELECT " . $columns . " FROM " . $table;
          if ($condition !== "") {
            $sql .= " WHERE " . $condition;
          }
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch(PDOException $e) {
          echo "Read failed: " . $e->getMessage();
          return false;
        }
      }

      public function afficher($columns, $data, $selectedColumns = [], $url) {
        $num = 1;
        $output = '<table id="example" class="table">';
        $output .= '<thead><tr>';
        $output .= '<th scope="col">#</th>';
        foreach($columns as $column) {
            $output .= '<th scope="col">' . $column . '</th>';
        }
        $output .= '<th scope="col">Action</th>';
        $output .= '</tr></thead><tbody>';
        foreach($data as $row) {
            $output .= '<tr>';
            $output .= '<input type="hidden" class="id" name="id" value="'. $row[array_key_first($row)] .'" />';
            $output .= '<th scope="row">' . $num . '</th>';
            if (!empty($selectedColumns)) {
                foreach($selectedColumns as $column) {
                    $output .= '<td>' . $row[$column] . '</td>';
                }
            } else {
                foreach($row as $key => $value) {
                    $output .= '<td>' . $value . '</td>';
                }
            }
            $output .= '<td>';
            $output .= '<a href="' . $url . '?action=modifier&id=' . $row[array_key_first($row)] . '"><i class="bi bi-pencil-square modifier" style="color: green; font-size: 15px; margin-top: 7px; margin-right: 4px;"></i></a> ';
            $output .= '<a href="' . $url . '?action=voir&id=' . $row[array_key_first($row)] . '"><i class="bi bi-eye" style="color: #4D6194; font-size: 15px; margin-top: 7px; margin-right: 4px;"></i></a> ';
            $output .= '<a href="' . $url . '?action=supprimer&id=' . $row[array_key_first($row)] . '"><i class="bi bi-trash" style="color: red; font-size: 15px; margin-top: 7px; margin-right: 2px;"></i></a>';
            $output .= '</td>';
            $output .= '</tr>';
            $num++;
        }
        $output .= '</tbody></table>';
        return $output;
    }
    
  }
  
// Définir les informations de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bibliotheque');

// Créer une nouvelle instance de la classe Database
$bd = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$bd->connecter();
// Déclarer la variable $bd en tant que variable globale
global $bd;
