<?php

namespace Core;

use Core\Contracts\DatabaseInterface;
use Exception;
use PDO;

class Database implements DatabaseInterface
{

    private PDO $pdo;

    public function __construct(array $c)
    {
        $host = $c['host'];
        $dbname = $c['base'];
        $pass = $c['pass'];
        $user = $c['user'];

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "DB connection failed: " . $e->getMessage();
            die;
        }
    }

    public function getRows(string $query): array
    {
        try {
            $stmt = $this->pdo->query($query);
            $result = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getRowBy(int $userId, string $table, string $by = 'id'): array|null
    {
        try {

            $query = "SELECT * FROM $table WHERE $by = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':' . $by, $userId, PDO::PARAM_INT);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return $user;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function getRowById(int $userId, string $table): array|null
    {
        return $this->getRowBy($userId, $table, 'id');
    }

    public function insertRow(string $table, array $data, array $fields): bool
    {
        try {
            if (empty($data) || empty($fields)) {
                throw new Exception("Data and fields arrays must not be empty.");
            }

            $fieldsetFields = implode(', ', $fields);
            $fieldsetValues = ':' . implode(', :', $fields);

            $query = "INSERT INTO $table ($fieldsetFields) VALUES ($fieldsetValues)";

            $stmt = $this->pdo->prepare($query);

            foreach ($data as $field => $value) {
                if (in_array($field, $fields)) {
                    $stmt->bindValue(':' . $field, $value);
                }
            }

            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception("Insert failed: " . $e->getMessage());
        }
    }

    public function updateRow(string $table, array $data, array $fields, int $id): bool
    {

        try {
            if (empty($data) || empty($fields)) {
                throw new Exception("Data and fields arrays must not be empty.");
            }

            $setFields = '';
            foreach ($fields as $field) {
                if (array_key_exists($field, $data)) {
                    $setFields .= "$field = :$field, ";
                }
            }
            $finalSetFields = rtrim($setFields, ', ');

            $query = "UPDATE $table SET $finalSetFields WHERE id = :id";

            $stmt = $this->pdo->prepare($query);

            foreach ($data as $field => $value) {
                if (array_key_exists($field, $data)) {
                    $stmt->bindValue(':' . $field, $value);
                }
            }
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Update failed: " . $e->getMessage());
        }
    }

    public function deleteRowById(string $table, int $id): bool
    {
        try {
            $query = "DELETE FROM $table WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Delete failed: " . $e->getMessage());
        }
    }

    public function deleteRowsByField(string $table, string $fieldName, string $fieldValue): bool
    {
        try {
            $query = "DELETE FROM $table WHERE $fieldName = :value";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':value', $fieldValue);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Delete failed: " . $e->getMessage());
        }
    }
}
